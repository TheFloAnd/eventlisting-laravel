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
                            ]" />

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
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="card-header justify-content-center">
                        <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                            href="{{ route('users.show', [$user->id, $user->name]) }}">
                            {{ __('Anzeigen') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 justify-content-center">
                            {{-- User Name --}}
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="evnameent" placeholder="{{ $user->name ?? old('name') }}"
                                            value="{{ $user->name ?? old('name') }}" maxlength="50" required
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Name') }}"
                                            data-show-input-length>
                                        <label for="name">
                                            {{ __('Name') }}
                                            <span style="color: red;">
                                                *
                                            </span>
                                            <span id="name_label" class="label"></span>
                                        </label>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            {{-- User E-Mail --}}
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="{{ $user->email ?? old('email') }}"
                                            value="{{ $user->email ?? old('email') }}" maxlength="50" required
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('email') }}"
                                            data-show-input-length>
                                        <label for="email">
                                            {{ __('E-Mail Adresse') }}
                                            <span style="color: red;">
                                                *
                                            </span>
                                            <span id="email_label" class="label"></span>
                                        </label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            {{-- User Password --}}
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="{{ old('password') ?? __('Passwort') }}"
                                            value="{{ old('password') ?? __('') }}" maxlength="50" required
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('password') }}" data-show-input-length>
                                        <label for="password">
                                            {{ __('Passwort') }}
                                            <span style="color: red;">
                                                *
                                            </span>
                                            <span id="password_label" class="label"></span>
                                        </label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            {{-- Password Confirm --}}
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('confirm-password') is-invalid @enderror"
                                            name="confirm-password" id="confirm-password"
                                            placeholder="{{ old('confirm-password') ?? __('Passwort') }}"
                                            value="{{ old('confirm-password') ?? __('') }}" maxlength="50" required
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('confirm-password') }}" data-show-input-length>
                                        <label for="password">
                                            {{ __('Passwort Bestätigen') }}
                                            <span style="color: red;">
                                                *
                                            </span>
                                            <span id="confirm-password_label" class="label"></span>
                                        </label>
                                        @error('confirm-password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </fieldset>
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
                            {{-- User Select Roles --}}
                            <div class="col-lg-10">
                                <div class="row g-3" id="groups">
                                    <div class="col-12">
                                        <fieldset>
                                            <div class="input-group">
                                                <label for="group">
                                                    {{ __('Gruppe(n)') }}
                                                    <span style="color: red;">
                                                        *
                                                    </span>
                                                </label>
                                                <select
                                                    class="form-select multiple-select @error('roles') is-invalid @enderror"
                                                    name="roles[]" id="roles" multiple="multiple" required
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('An dem Termin Teilnehmende Gruppen') }}">
                                                    @foreach ($roles as $row)
                                                    @if($user->hasRole($row))
                                                    <option value="{{ $row }}" selected>
                                                        {{ $row }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $row }}">
                                                        {{ $row }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('roles')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </fieldset>
                                    </div>
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
                                    href="{{ route('users') }}">
                                    {{ __('Zurück') }}
                                </a>
                            </div>
                            @can('user-ban')
                            @if(!$user->hasRole(['administrator']))
                            <div class="col-8 col-lg-5">
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
                            </div>
                            @endif
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(!$user->hasRole(['administrator']))
<div class="modal fade" id="Modal_reaktivate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Aktivieren') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{ $txt ?? 'Wollen sie den Benutzer wirklich Reaktivieren?'}}
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
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="Modal_deaktivate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Deaktivieren') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
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
            </form>
        </div>
    </div>
</div>
@endif
@endsection
