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
                                        [__($role->name), 'roles.show', [$role->id, $role->name]],
                                        [__('Bearbeiten'), 'roles.edit', [$role->id, $role->name]]
                                    ]" />
    </section>
    <section class="col-12">
        <div class="card">
            <div class="card-header justify-content-center">
                <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                    href="{{ route('roles.show', [$role->id, $role->name]) }}">
                    {{ __('Nur Anzeigen') }}
                </a>
            </div>
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @method('patch')
                @csrf
                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        <div class="col-lg-10">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="{{ old('name') ?? $role->name }}"
                                        value="{{ old('name') ?? $role->name }}" maxlength="25" required
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
                            <div class="row g-3">
                                <div class="col-12">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="select_all_modal"
                                                    data-toggle="toggle" autocomplete="off" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ __('Alle Auswählen.') }}"
                                                    data-toggle-select>
                                                <label class="form-check-label" for="select_all">
                                                    {{ __('Alle Auswählen.') }}
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                    <div class="row" data-area-select>
                                        @foreach($permission as $value)

                                        <div class="col-auto">
                                            <fieldset>
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permission[]" id="permission" value="{{ $value->id }}"
                                                            data-set-select {{ in_array($value->id, $rolePermissions)?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="not_applicable">
                                                            {{ $value->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row g-3 justify-content-center">
                        <div class="col-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100" name="submit_event"
                                    value="{{ __('Ändern') }}">
                                    {{ __('Ändern') }}
                                </button>
                            </div>
                        </div>
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
            </form>
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
