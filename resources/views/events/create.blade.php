@extends('layouts.app')

@section('content')
<article class="row g-3">
<div class="col-12">
    <div class="row d-flex align-content-center">
        <div class="col-md-8">
            <h1>
                {{ $title }}
            </h1>
        </div>
        <div class="col-md-4">
            <a href="#" type="button" class="btn btn-outline-secondary w-100">
                {{ __('Zurück') }}
            </a>
        </div>
    </div>
</div>
    <!-- Auflistung -->
    <section class="col-12 events-section">
        <div class="card events-card">
            <form method="POST" action="{{ route('events.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="event" id="event"
                                        placeholder="{{ __('Termin') }}" list="event_list" maxlength="50" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Termin Name') }}"
                                        data-show-input-length>
                                    <label for="event">
                                        {{ __('Termin') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="event_label" class="label"></span>
                                    </label>
                                    @error('event')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <datalist id="event_list">
                                        @foreach ($proposal as $row)
                                        <option value="{{ $row->event }}">
                                            @endforeach
                                    </datalist>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-10">
                            <div class="row g-3" id="groups">
                                <div class="col-12">
                                    <fieldset>
                                        <div class="input-group has-validation">
                                            <label for="group">
                                                {{ __('Gruppe(n)') }}
                                                <span style="color: red;">
                                                    *
                                                </span>
                                            </label>
                                            <select class="form-select multiple-select" name="group[]" id="group"
                                                multiple="multiple" required data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ __('An dem Termin Teilnehmende Gruppen') }}">
                                                @foreach ($groups as $row)
                                                <option value="{{ $row->alias }}">{{ $row->name }} ({{ $row->alias }})
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('group')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="room" id="room"
                                                placeholder="{{ __('Raum') }}" list="room_list" maxlength="25"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Raum wo der Termin stattfindet') }}"
                                                data-show-input-length>
                                            <label for="room">
                                                {{ __('Raum') }}

                                                <span id="room_label" class="label"></span>
                                            </label>
                                            @error('room')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                            <datalist id="room_list">
                                                @foreach ($proposal_room as $row)
                                                <option value="{{ $row->room }}">
                                                    @endforeach
                                            </datalist>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" name="start_date" id="start_date"
                                        value="{{ date('Y-m-d\T00:00') }}" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Datum/Zeit wann der Termin Startet.') }}">
                                    <label for="start_date">
                                        {{ __('Start') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-5">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local" class="form-control" name="end_date" id="end_date"
                                        value="{{ date('Y-m-d\T00:00') }}" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Datum/Zeit wann der Termin Endet.') }}">
                                    <label for="end_date">
                                        {{ __('Endet') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <hr class="separator">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row g-3 justify-content-center">
                        <div class="col-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100" name="submit_event"
                                    value="submit">
                                    {{ __('Hinzufügen') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

</article>
@endsection
