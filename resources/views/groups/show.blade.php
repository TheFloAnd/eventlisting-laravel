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
            <form method="patch" action="{{ route('groups.update', $result->alias) }}">
                @csrf
                <div class="card-body" style="background: rgba(200, 200, 200, 0.2);">
                    <div class="row mt-3 g-3 justify-content-center">
                        <div class="col-md-10">
                            <div class="row mt-3 g-3 justify-content-center" disabled>
                                <div class="col-12">
                                    <fieldset id="input_name">
                                        <div class="form-floating has-validation">
                                            <input type="text" class="form-control disable show_length"
                                                name="group_name" id="group_name"
                                                placeholder="{{ $result->name ?? __('Gruppen Name') }}"
                                                value="{{ $result->name }}" maxlength="100" required
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Die volle Bezeichnung für die Gruppe') }}" disabled>
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
                                <div class="col-10">
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

                                <div class="col-2">
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
                                                data-bs-placement="top"
                                                title="{{ __('Darstellungs Farbe für die Gruppe!') }}" disabled>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12">
                        <div class="row g-2 justify-content-evenly">
                            <div class="col-8">
                                <div class="form-group">
                                    <a type="button" class="btn btn-outline-success w-100" name="submit_edit_group"
                                        href="{{ route('groups.edit', $result->alias) }}">
                                        {{ __('Bearbeiten') }}
                                    </a>
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
                            <div class="col-10">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-danger w-100" name="submit_edit_group"
                                        data-bs-toggle="modal" data-bs-target="#modal_deactive_group"
                                        data-bs-modal-groupAlias="{{ $result->alias }}">
                                        {{ __('Deaktivieren') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</article>

<div class="modal fade" id="modal_deactive_group" tabindex="-1" aria-labelledby="modal_deactive_group_Label"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('groups.index') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <p>
                                Die Gruppe <b><i><span id="modal_deaktivate_group_alias"></span></i></b>
                            </p>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
                                {{ __('Schließen') }}
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-outline-danger w-100" name="login">
                                {{ __('deaktivieren') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var deaktivationModal = document.getElementById('modal_deactive_group')
    deaktivationModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-modal-groupAlias')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalBodyInput = deaktivationModal.querySelector('#modal_deaktivate_group_alias')
    modalBodyInput.innerHTML = recipient
    })
</script>
@endsection
