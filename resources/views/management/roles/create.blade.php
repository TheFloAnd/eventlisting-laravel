@extends('layouts.app')


@section('content')


<x-breadcrumb :breadcrumb="[
                                ['Rollen', 'roles.index'],
                                ['Rollen Hinzufügen', 'roles.create'],
                            ]" />

<div class="row d-flex justify-content-center">
    <div class="col-md-11 col-lg-10">
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
                        <div class="col-md-11 col-lg-10">
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
                                                            data-set-select>
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
                    <div class="row g-2 justify-content-center">
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-sm btn-rounded btn-outline-success w-100">
                                Speichern
                                <span class="btn-icon-right pull-right mr-auto">
                                    <i class="fas fa-check"></i>
                                </span>
                            </button>
                        </div>
                        <div class="col-sm-4">
                            @if(Route::has('roles'))
                            <a class="btn btn-sm btn-rounded btn-outline-secondary w-100" href="{{ route('roles') }}">
                                Zurück</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
