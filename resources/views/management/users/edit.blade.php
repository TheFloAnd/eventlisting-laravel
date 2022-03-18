@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="form-head d-flex mb-0 align-items-start">
                <div class="mr-auto">
                    <h2 class="text-black font-w600 mb-0">
                        {{ $title}}
                    </h2>
                </div>
                <div class="ml-auto pull-right">
                    <a class="btn btn-md btn-rounded btn-outline-info" href="{{ route('users.index') }}">
                        {{ __('Zurück') }}
                    </a>
                </div>
            </div>
        </div>

        <x-breadcrumb :breadcrumb="[
                                ['Benutzer', 'users.index'],
                                [__($user->name), 'users.show', [$user->id, $user->name]],
                                ['Bearbeiten', 'users.edit', [$user->id, $user->name]]
                            ]"/>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <h4>Whoops!</h4> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-md-11 col-lg-10">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                           href="{{ route('users.show', [$user->id, $user->name]) }}">
                            {{ __('Nur Anzeigen') }}
                        </a>
                    </div>
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    <div class="card-body">
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-5 col-lg-5">
                                <div class="form-floating">
                                    <!-- <h4>Name:</h4> -->
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    <label for="name">
                                        Name
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-floating">
                                    <!-- <h4>Email:</h4> -->
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    <label for="email">
                                        E-Mail Adresse
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Password:</h4> -->
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    <label for="password">
                                        Passwort
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Confirm Password:</h4> -->
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    <label for="confirm-password">
                                        Passwort Bestätigen
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            @if(!empty($user->blocked_at))
                                <div class="col-md-11 col-lg-10">
                                    <div class="form-group">
                                        <h4>{{ __('Gesperrt:') }}</h4>
                                        <label class="badge badge-md badge-pill badge-outline-danger">
                                            {{ $user->blocked_at }}
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-11 col-lg-10">
                                <div class="form-group">
                                    <h4>Role:</h4>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control multi-value-select','multiple')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row g-2 justify-content-center">
                            <div class="col-8 col-lg-5">
                                <button type="submit" value="save" name="save"
                                        class="btn btn-md btn-rounded btn-outline-success w-100">
                                    {{ __('Speichern') }}
                                </button>
                            </div>
                            <div class="col-4 col-lg-2">
                                <a class="btn btn-md btn-rounded btn-outline-secondary w-100"
                                   href="{{ route('users.index') }}">
                                    {{ __('Zurück') }}
                                </a>
                            </div>
                            @can('user-ban')
                                @if(!$user->hasRole(['administrator']))
                                    <div class="col-8 col-lg-5">
                                        @if(empty($user->blocked_at))
                                            <button type="button" value="deactivate" name="deactivate"
                                                    class="btn btn-md btn-rounded btn-outline-danger w-100"
                                                    data-toggle="modal" data-target="#Modal_deaktivate">
                                                {{ __('Deaktivieren') }}
                                            </button>
                                        @else
                                            <button type="button" value="reactivate" name="reactivate"
                                                    class="btn btn-md btn-rounded btn-outline-danger w-100"
                                                    data-toggle="modal" data-target="#Modal_reaktivate">
                                                {{ __('Reaktivieren') }}
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            @endcan
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

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
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    <div class="modal-body">
                        {{$txt ?? 'Wollen sie den Benutzer wirklich Reaktivieren?'}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="reactivate" name="reactivate"
                                class="btn btn-md btn-rounded btn-outline-danger w-100">
                            {{ __('Reaktivieren') }}
                        </button>
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100"
                                data-dismiss="modal">
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
                        <h5 class="modal-title">{{ __('Deaktivieren') }}</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    <div class="modal-body">
                        {{$txt ?? 'Wollen sie den Benutzer wirklich Deaktivieren?'}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deactivate" name="deactivate"
                                class="btn btn-md btn-rounded btn-outline-danger w-100">
                            {{ __('Deaktivieren') }}
                        </button>
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100"
                                data-dismiss="modal">
                            Schließen
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection
