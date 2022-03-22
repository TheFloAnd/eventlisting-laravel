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
                                    [__('Benutzer'), 'users.index'],
                                    [__($user->name), 'users.show', [$user->id, $user->name]],
                                ]" />
    </section>
    <section class="col-md-10 col-md-11 col-lg-10">
        <div class="card">
            @can('user-edit')
            <div class="card-header justify-content-center">
                <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                    href="{{ route('users.edit', [$user->id, $user->name]) }}">
                    {{ __('Bearbeiten') }}
                </a>
            </div>
            @endcan
            <div class="card-body">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <!-- <h4>{{ __('Name:') }}</h4> -->
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                            <label for="name">
                                Name
                                <strong style="color:red;">*</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <!-- <h4>{{ __('Email-Adresse:') }}</h4> -->
                            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                            <label for="email">
                                E-Mail Adresse
                                <strong style="color:red;">*</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-11 col-lg-10">
                        <div class="form-group">
                            <h4>{{ __('Role:') }}</h4>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            @switch(TRUE)
                            @case(stristr($v,'admin'))
                            <label class="badge badge-md badge-pill badge-outline-danger">
                                {{ $v }}
                            </label>
                            @break
                            @case(stristr($v,'user'))
                            <label class="badge badge-md badge-pill badge-outline-primary">
                                {{ $v }}
                            </label>
                            @break
                            @default
                            <label class="badge badge-md badge-pill badge-outline-secondary">
                                {{ $v }}
                            </label>
                            @endswitch
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @if(!empty($user->blocked_at))
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <h4>{{ __('Gesperrt:') }}</h4>
                            <label class="badge badge-md badge-pill badge-outline-danger">
                                {{ $user->blocked_at }}
                            </label>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <a class="btn btn-md btn-rounded btn-outline-primary w-100" href="{{ route('users.index') }}">
                            {{ __('Zurück') }}
                        </a>
                    </div>
                    @can('user-ban')
                    @if(!$user->hasRole(['administrator']))
                    <div class="col-4">
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                        @if(empty($user->blocked_at))
                        <button type="button" value="deactivate" name="deactivate"
                            class="btn btn-md btn-rounded btn-outline-danger w-100" data-toggle="modal"
                            data-target="#Modal_deaktivate">
                            {{ __('Deaktivieren') }}
                        </button>
                        @else
                        <button type="button" value="reactivate" name="reactivate"
                            class="btn btn-md btn-rounded btn-outline-danger w-100" data-toggle="modal"
                            data-target="#Modal_reaktivate">
                            {{ __('Reaktivieren') }}
                        </button>
                        @endif
                        {!! Form::close() !!}
                    </div>
                    @endif
                    @endcan
                </div>
            </div>
        </div>
    </section>
</article>
@if(!$user->hasRole(['administrator']))
<div class="modal fade" id="Modal_reaktivate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Aktivieren') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                {{$txt ?? 'Wollen sie den Benutzer wirklich Reaktivieren?'}}
            </div>
            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="modal-footer">
                <button type="submit" value="reactivate" name="reactivate"
                    class="btn btn-md btn-rounded btn-outline-danger w-100">
                    {{ __('Reaktivieren') }}
                </button>
                <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100" data-dismiss="modal">
                    Schließen
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="Modal_deaktivate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Aktivieren') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                {{$txt ?? 'Wollen sie den Benutzer wirklich Deaktivieren?'}}
            </div>
            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="modal-footer">
                <button type="submit" value="deactivate" name="deactivate"
                    class="btn btn-md btn-rounded btn-outline-danger w-100">
                    {{ __('Deaktivieren') }}
                </button>
                <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100" data-dismiss="modal">
                    Schließen
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
@endsection
