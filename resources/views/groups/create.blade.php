@extends('layouts.app')

@section('content')

@if (count($errors) > 0)
<x-alert.error :errors="$errors" />
@endif

<article class="row g-3">
    <section>
        <h1>
            {{ $title }}
        </h1>
    </section>
    <section class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('groups.store') }}">
                    @csrf
                    <div class="row mt-3 g-3 justify-content-center">
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-floating has-validation">
                                    <input type="text" class="form-control @error('group_name') is-invalid @enderror"
                                        name="group_name" id="group_name"
                                        placeholder="{{ old('group_name') ?? __('Gruppen Name') }}" maxlength="100"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Die volle Bezeichnung für die Gruppe') }}" data-show-input-length>
                                    <label for="group_name">
                                        {{ __('Gruppen Name') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="group_name_label" class="label"></span>
                                    </label>
                                    @error('group_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-8">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('group_alias') is-invalid @enderror"
                                        name="group_alias" id="group_alias"
                                        placeholder="{{ old('group_alias') ?? __('Gruppen Alias') }}" maxlength="10"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Ein Kürzel für die Gruppe') }}" data-show-input-length>
                                    <label for="group_alias">
                                        {{ __('Gruppen Alias') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="group_alias_label" class="label"></span>
                                    </label>
                                    @error('group_alias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-2">
                            <fieldset>
                                <div class="form-group">
                                    <label for="floatingInput">
                                        {{ __('Gruppen Farbe') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                    <input type="color" class="form-control form-control-color" name="group_color"
                                        id="group_color" value="{{ old('group_color') ?? $color }}" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="
                                    {{ __('Darstellungs Farbe für die Gruppe!') }}">
                                    @error('group_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100" name="submit_group"
                                    value="{{ __('Hinzufügen') }}">
                                    {{ __('Hinzufügen') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <a type="button" class="btn btn-outline-secondary w-100"
                                    href="{{ route('groups') }}">
                                    {{ __('Zurück') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</article>
@endsection
