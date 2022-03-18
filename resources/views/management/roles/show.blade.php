@extends('layouts.app')


@section('content')

<x-page_title :title="$title" :route="'roles.create'" :icon="'user-tag'" :btn_txt="'Rolle Erstellen'" :add="'1'" />

<x-breadcrumb :breadcrumb="[
                                ['Rollen', 'roles.index'],
                                [__($role->name), 'roles.show', [$role->id, $role->name]]
                            ]" />

<div class="row d-flex justify-content-center">
    <div class="col-md-11 col-lg-10">
        <div class="card">
            @can('role-edit')
            <div class="card-header justify-content-center">
                <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                    href="{{ route('roles.edit', [$role->id, $role->name]) }}">
                    {{ __('Bearbeiten') }}
                </a>
            </div>
            @endcan
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-11 col-lg-10">
                        <div class="form-group">
                            <label>
                                <h4>Name:</h4>
                            </label>
                            <input type="text" class="form-control" value="{{ $role->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-11 col-lg-10">
                        <div class="form-group">
                            <h4>Berechtigungen:</h4>
                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            @switch(TRUE)
                            @case(stristr($v->name,'role'))
                            <label class="badge badge-rounded badge-outline-danger">{{ $v->name }}
                                ,</label>
                            @break
                            @case(stristr($v->name,'user'))
                            <label class="badge badge-rounded badge-outline-warning">{{ $v->name }}
                                ,</label>
                            @break
                            @case(stristr($v->name,'drink'))
                            <label class="badge badge-rounded badge-outline-info">{{ $v->name }}
                                ,</label>
                            @break
                            @default
                            <label class="badge badge-rounded badge-outline-secondary">{{ $v->name }}
                                ,</label>
                            @endswitch
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row g-2 justify-content-center">
                    @if($role->name == 'administrator')
                    <div class="col-sm-5">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-danger w-100"
                            data-toggle="modal" data-target="#delete_role">
                            Löschen
                            <span class="btn-icon-right pull-right mr-auto">
                                <i class="fas fa-trash"></i>
                            </span>
                        </button>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        @if(Route::has('roles'))
                        <a class="btn btn-sm btn-rounded btn-outline-secondary w-100" href="{{ route('roles') }}">
                            Zurück
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
