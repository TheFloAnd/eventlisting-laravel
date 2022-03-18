<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRequest;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {
        $this->middleware(['auth', 'active_user']);
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        $user = Auth::user();

        return view('management.users.index', compact('data', 'user'), ['title' => 'Benutzer Liste'])->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        if (!Auth::user()->hasRole('administrator')) {
            $roles = Role::where([['name', '!=', 'administrator'], ['name', '!=', 'moderator']])
                ->pluck('name', 'name')
                ->all();
        } else {
            $roles = Role::pluck('name', 'name')
                ->all();
        }
        return view('management.users.create', compact('roles'), ['title' => 'Benutzer Erstellen']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id, $name)
    {
        $user = User::find($id);
        return view('management.users.show', compact('user', 'id'), ['title' => 'Benutzer Anzeigen']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id, $name)
    {
        $user = User::find($id);

        $roles = [''];
        //  $roles = Role::pluck('name','name')->all();
        if (!Auth::user()->hasRole('administrator')) {
            $roles = Role::where([['name', '!=', 'administrator'], ['name', '!=', 'moderator']])
                ->pluck('name', 'name')
                ->all();
        } else {
            $roles = Role::pluck('name', 'name')
                ->all();
        }

        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('management.users.edit', compact('user', 'roles', 'userRole', 'id'), ['title' => 'Benutzer Bearbeiten']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $message = 'Error';
        if (isset($request->save)) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));

            $message = 'User successfully updated';
        }
        if (isset($request->deactivate)) {
            DB::table('users')->where('id', $id)->update(['blocked_at' => now()]);

            $message = 'User successfully banned';
        }
        if (isset($request->reactivate)) {
            DB::table('users')->where('id', $id)->update(['blocked_at' => NULL]);

            $message = 'User successfully unbanned';
        }
        return redirect()->route('users.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
