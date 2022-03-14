@extends('layouts.app')

@section('content')
<article class="row g-3">
    <section class="col-12">
        <form action="{{ route('settings.update') }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card">
                <div class="card-header">
                    <h1>
                        {{ $title }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2>
                                                {{ __('Überschrift:') }}
                                            </h2>
                                        </div>
                                        <div class="col-lg-8">

                                            <fieldset>
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" id="name"
                                                        placeholder="{{ old('name') ?? __('Name') }}"
                                                        value="{{ old('event') ?? $name->value }}" maxlength="50"
                                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Name/Überschrift der Anwendung') }}"
                                                        data-show-input-length required>
                                                    <label for="name">
                                                        {{ __('Name/Überschrift') }}
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
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2>
                                                {{ __('Preview Zeitraum:') }}
                                            </h2>
                                        </div>
                                        <div class="col-6 col-lg-4">
                                            <fieldset>
                                                <div class="form-floating">
                                                    <input type="number"
                                                        class="form-control @error('preview_value') is-invalid @enderror"
                                                        name="preview_value" id="preview_value"
                                                        placeholder="{{ old('preview_value') ?? $preview_time->value }}"
                                                        value="{{ old('preview_value') ?? $preview_time->value }}"
                                                        min="1" required data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{ __('Zeitraum der Künftigen Termine die Angezeigt werden') }}"
                                                        required>
                                                    <label for="preview_value">
                                                        {{ __('Preview Zeitraum') }}
                                                        <span style="color: red;">
                                                            *
                                                        </span>
                                                    </label>
                                                    @error('preview_value')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-6 col-lg-4">
                                            <fieldset>
                                                <div class="form-floating">
                                                    <select class="form-select" id="preview_unit" name="preview_unit"
                                                        aria-label="{{ __('Einheit') }}">
                                                        @if ($preview_time->unit == 'day')
                                                        <option value="day">{{ __('Tage') }}</option>
                                                        <option value="week">{{ __('Wochen') }}</option>
                                                        @endif
                                                        @if ($preview_time->unit == 'week') {
                                                        <option value="week">{{ __('Wochen') }}</option>
                                                        <option value="day">{{ __('Tage') }}</option>
                                                        @endif
                                                    </select>
                                                    <label for="preview_unit">
                                                        {{ __('Preview Einheit') }}
                                                        <span style="color: red;">
                                                            *
                                                        </span>
                                                    </label>
                                                    @error('preview_unit')
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2>
                                                {{ __('Neuladen:') }}
                                            </h2>
                                        </div>
                                        <div class="col-lg-8">

                                            <fieldset>
                                                <div class="form-floating">
                                                    <input type="number"
                                                        class="form-control @error('refresh_delay') is-invalid @enderror"
                                                        name="refresh_delay" id="refresh_delay"
                                                        placeholder="{{ old('refresh_delay') ?? __('Neulade Abstände') }}"
                                                        value="{{ old('event') ?? $refresh_delay->value }}" min="15"
                                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Abstände in den die Termine aktualisiert werden sollen.') }}"
                                                        required>
                                                    <label for="refresh_delay">
                                                        {{ __('Neulade Abstände') }}
                                                        <span style="color: red;">
                                                            *
                                                        </span>
                                                    </label>
                                                    @error('refresh_delay')
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
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row g-3 justify-content-center">
                        <div class="col-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100" name="submit_settings">
                                    {{ __('Speicher') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    {{-- <section class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('Datenbank') }}
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-12">
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-outline-success w-100" name="table_backup"
                                id="table_backup">Backup</button>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="btn-group btn-group-vertical w-100" role="group"
                            aria-label="Basic checkbox toggle button group">
                            <input type="button" class="btn-check" id="table_events" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="events">
                            <label class="btn btn-outline-danger" for="table_events">
                                events
                            </label>

                            <input type="button" class="btn-check" id="table_groups" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="groups">
                            <label class="btn btn-outline-danger" for="table_groups">
                                groups
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}
</article>
<div class="modal fade" id="modal_table" tabindex="-1" aria-labelledby="modal_tableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tableLabel">
                        delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-2">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-auto mx-0">
                                    <label class="form-check-label" for="table_empty">
                                        delete
                                    </label>
                                </div>
                                <div class="col-auto mx-0">
                                    <div class="form-check form-switch">
                                        <input class=" form-check-input" type="checkbox" value="1" name="table_empty"
                                            id="table_empty" checked>
                                    </div>
                                </div>
                                <div class="col-auto mx-0">

                                    <label class="form-check-label" for="table_empty">
                                        to_empty
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">

                            <fieldset>
                                <div class="form-group">
                                    <input class="input_table" id="modal_table_input" value="" name="modal_table_input"
                                        readOnly>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <p>
                                delete_table
                            </p>
                            <span>
                                delete_table-info
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mb-2">

                        <fieldset>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="protection_pass" id="protection_pass"
                                    placeholder="Password">
                                <label for="protection_pass">Password</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            close
                        </button>
                        <button type="submit" class="btn btn-danger" name="tabel_renew">
                            submit
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script>
    var modal_table = document.getElementById('modal_table')
  modal_table.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var table = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = modal_table.querySelector('.modal-title')
    var modalBodyInput = modal_table.querySelector('.modal-body .input_table')

    modalTitle.textContent = 'database-table: ' + table
    modalBodyInput.value = table
  })
</script>
@endsection
