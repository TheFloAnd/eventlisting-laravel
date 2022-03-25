@extends('layouts.app')


@section('content')

@if($errors->any())
@foreach ($errors->all() as $error)
<x-alert type="error" :message="$error" />
@endforeach
@endif

<article class="row g-3">
    <section class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('roles.index') }}" type="button" class="btn btn-outline-secondary w-100">
                    {{ __('Zurück') }}
                </a>
            </div>
        </div>

        <x-breadcrumb :breadcrumb="[
                                        [__('Rollen'), 'roles.index'],
                                        [__('Rollen Hinzufügen'), 'roles.create'],
                                    ]" />
    </section>

    <section class="col-12">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('roles.store') }}" method="post">
                        @method('post')
                        @csrf
                        <div class="card-body">
                            <div class="row g-3 justify-content-center">
                                <div class="col-lg-10">
                                    <fieldset>
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="{{ old('name') ?? __('Name') }}"
                                                value="{{ old('name') ?? __('') }}" maxlength="25" required
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Name') }}" data-show-input-length>
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
                                <div class="col-md-11 col-lg-10">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <fieldset>
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="select_all_modal" data-toggle="toggle"
                                                            autocomplete="off" data-bs-toggle="tooltip"
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
                                                                    name="permission[]" id="permission"
                                                                    value="{{ $value->id }}" data-set-select>
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
                                            value="{{ __('Hinzufügen') }}">
                                            {{ __('Hinzufügen') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</article>
@endsection
