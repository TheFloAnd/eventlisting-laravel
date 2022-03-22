@extends('layouts.app')


@section('content')

<article class="row g-3">
    <section class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('users.index') }}" type="button" class="btn btn-outline-secondary w-100">
                    {{ __('Zurück') }}
                </a>
            </div>
        </div>

        <x-breadcrumb :breadcrumb="[
                                        [__('Rollen'), 'roles.index'],
                                        [__($role->name), 'roles.show', [$role->id, $role->name]]
                                    ]" />
    </section>
    <section class="col-md-11 col-lg-10">
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
                <div class="row g-3 justify-content-center">
                    @if(Auth::user()->hasRole(['administrator']))
                    @if($role->name != 'administrator')
                    <div class="col-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-outline-danger w-100" name="submit_event"
                                value="{{ __('Löschen') }}" data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                {{ __('Löschen') }}
                            </button>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
</article>

@if($role->name != 'administrator')
<div class="modal fade" id="Modal_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Löschen') }}</h5>
                <button type="button" class="btn-close dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('Wollen sie den Benutzer wirklich Löschen?') }}
            </div>
            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-footer">
                    <button type="submit" value="reactivate" name="reactivate"
                        class="btn btn-md btn-rounded btn-outline-danger w-100">
                        {{ __('Löschen') }}
                    </button>
                    <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100"
                        data-dismiss="modal">
                        {{ __('Schließen') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection
