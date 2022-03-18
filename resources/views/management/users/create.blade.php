@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="form-head d-flex mb-0 align-items-start">
            <div class="mr-auto">
                <h2 class="text-black font-w600 mb-0">
                    {{ $title ?? '' }}
                </h2>
            </div>
            <div class="ml-auto pull-right">
                <a class="btn btn-md btn-rounded btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <x-breadcrumb :breadcrumb="[
                                ['Benutzer', 'users.index'],
                                ['Benutzer Hinzufügen', 'users.create'],
                            ]" />

    <div class="row d-flex justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <form action="{{ route('users.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="card-body">


                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row g-3 justify-content-center">
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="evnameent" placeholder="{{ old('name') ?? __('Termin') }}"
                                            value="{{ old('name') ?? __('') }}" maxlength="50" required
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
                            <div class="col-lg-10">
                                <fieldset>
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email"
                                            placeholder="{{ old('email') ?? __('E-Mail Adresse') }}"
                                            value="{{ old('email') ?? __('') }}" maxlength="50" required
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
                                                    <option value="{{ $row }}">
                                                        {{ $row }}
                                                    </option>
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
                        <div class="col-10">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
