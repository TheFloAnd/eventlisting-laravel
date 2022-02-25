@extends('layouts.app')

@section('content')
<article class="row g-3">
    <section>
        <h1>
            {{ $title }}
        </h1>
    </section>

    <section class="col">
        <div class="card">
            <div class="card-body">
                <form method="PATCH" action="{{ route('groups.update', $result->alias) }}">
                    @csrf
                    <div class="row mt-3 g-3 justify-content-center">
                        <fieldset class="" hidden>
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" id="group_id"
                                    value="{{ $result->id }}">
                            </div>
                        </fieldset>
                        <fieldset class="" hidden>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alias" id="alias"
                                    value="{{ $result->alias }}">
                            </div>
                        </fieldset>
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="deactivate_group"
                                        id="deactivate_group" value="1" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Aktivieren/Deaktivien von Gruppen.') }}">
                                    <label class="form-check-label" for="deactivate_group">
                                        {{ __('Aktivieren/Deaktiven') }}
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-10">
                            <fieldset id="input_name">
                                <div class="form-floating has-validation">
                                    <input type="text" class="form-control disable show_length" name="group_name"
                                        id="group_name" placeholder="{{ $result->name ?? __('Gruppen Name') }}"
                                        value="{{ $result->name }}" maxlength="100" required data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="{{ __('Die volle Bezeichnung für die Gruppe') }}" data-set-disable>
                                    <label for="group_name">
                                        {{ __('Gruppen Name') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="group_name_label" class="label"></span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-8">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="group_alias" id="group_alias"
                                        placeholder="{{ $result->alias ?? __('Gruppen Alias') }}"
                                        value="{{ $result->alias }}" required disabled data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Ein Kürzel für die Gruppe') }}">
                                    <label for="group_alias">
                                        {{ __('Gruppen Alias') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-2">
                            <fieldset id="input_color">
                                <div class="form-group">
                                    <label for="group_color">
                                        {{ __('Gruppen Farbe') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                    <input type="color" class="form-control form-control-color disable"
                                        name="group_color" id="group_color" placeholder="{{ $result->color }}"
                                        value="{{ $result->color }}" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Darstellungs Farbe für die Gruppe!') }}" data-set-disable>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-10">
                            <div class="row g-2 justify-content-evenly">
                                <div class="col-8">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-success w-100"
                                            name="submit_edit_group" value="submit">
                                            {{ __('Aktualisieren') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <a type="button" class="btn btn-outline-secondary w-100" href="?b=groups">
                                            {{ __('Zurück') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</article>
@endsection
