@extends('layouts.app')

@section('content')

@if($errors->any())
@foreach ($errors->all() as $error)
<x-alert type="error" :message="$error" />
@endforeach
@endif
<x-breadcrumb :breadcrumb="[
                                    ['Termine', 'events'],
                                    ['Hinzufügen', 'events.create'],
                                ]" />
<article class="row g-3">
    <div class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
            <div class="col-lg-4">
                <a href="#" type="button" class="btn btn-outline-secondary w-100">
                    {{ __('Zurück') }}
                </a>
            </div>
        </div>
    </div>
    <!-- Auflistung -->
    <section class="col-12 events-section">
        <div class="card events-card">
            <form method="post" action="{{ route('events.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        <div class="col-lg-10">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('event') is-invalid @enderror"
                                        name="event" id="event" placeholder="{{ old('event') ?? __('Termin') }}"
                                        value="{{ old('event') ?? __('') }}" list="event_list" maxlength="50" required
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
                                                class="form-select multiple-select @error('group') is-invalid @enderror"
                                                name="group[]" id="group" multiple="multiple" required
                                                data-bs-toggle="tooltip" data-bs-placement="top"
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
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset>
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('room') is-invalid @enderror"
                                                name="room" id="room" placeholder="{{ old('room') ?? __('Raum') }}"
                                                value="{{ old('room') ?? __('') }}" list="room_list" maxlength="25"
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
                        <div class="col-lg-4">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        id="start_date" value="{{ old('start_date') ?? date('Y-m-d\T00:00') }}" required
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Datum/Zeit wann der Termin Startet.') }}">
                                    <label for="start_date">
                                        {{ __('Start') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>


                        <div class="col-4 col-lg-2">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="time" class="form-control @error('duration') is-invalid @enderror"
                                        name="duration" id="duration" value="{{ old('duration') ?? date('00:00') }}"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Datum/Zeit wann der Termin Endet.') }}">
                                    <label for="duration">
                                        {{ __('Dauer') }}
                                    </label>@error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>



                        <div class="col-8 col-lg-4">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        id="end_date" value="{{ old('start_date') ?? date('Y-m-d\T00:00') }}" required
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Datum/Zeit wann der Termin Endet.') }}">
                                    <label for="end_date">
                                        {{ __('Endet') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>@error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr class="separator">


                    <div class="row g-3 justify-content-center">
                        <div class="col-lg-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="repeat" name="repeat"
                                    data-toggle-disable>
                                <label class="form-check-label" for="repeat">{{ __('Wiederholen') }}</label>
                            </div>
                        </div>


                        <div class="col-lg-10">
                            <div class="row g-3 mb-3" data-area="disable">

                                {{-- <div class="col-12">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="">
                                                <input class="form-check-input set_repeat_time disable" type="radio"
                                                    name="set_repeat_time" id="set_repeat_time_date" value="date"
                                                    checked disabled data-set-disabled>
                                                <label class="form-check-label" for="set_repeat_time_date">
                                                    {{ __('Bis') }}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="">
                                                <input class="form-check-input set_repeat_time disable" type="radio"
                                                    name="set_repeat_time" id="set_repeat_time_repeats" value="repeats"
                                                    disabled data-set-disabled>
                                                <label class="form-check-label" for="set_repeat_time_repeats">
                                                    {{ __('Wiederholungen') }}
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="form-group" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('In welchen Intervallen sich der Termin wiederholen soll.') }}">
                                        <fieldset>
                                            <label class="form-label" for="repeat_interval">
                                                {{ __('Wiederholungs Interval (in Tagen)') }}:
                                            </label>
                                            <input class="form-control @error('repeat_interval') is-invalid @enderror"
                                                type="number"
                                                placeholder="{{ old('repeat_interval') ?? __('Wiederholungs Interval') }}"
                                                min="1" name="repeat_interval" id="repeat_interval"
                                                value="{{ old('repeat_interval') ?? '7' }}" disabled data-set-disabled>
                                            @error('repeat_interval')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Bis wann sich der Termin Wiederholen soll.') }}">
                                        <fieldset>
                                            <label class="form-label" for="repeat_till">
                                                {{ __('Bis') }}:
                                            </label>
                                            <input class="form-control @error('repeat_till') is-invalid @enderror"
                                                type="date"
                                                placeholder="{{ old('repeat_till') ?? date('Y-m-d', strtotime(date('Y-m-d') . ' +1 month')) }}"
                                                name="repeat_till" id="repeat_till"
                                                value="{{ old('repeat_till') ?? date('Y-m-d', strtotime(date('Y-m-d') . ' +1 month')) }}"
                                                disabled data-set-disabled>
                                            @error('repeat_till')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="form-group" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                                        <fieldset>
                                            <label class="form-label" for="repeats">
                                                {{ __('Wiederholungen') }}:
                                            </label>
                                            <input class="form-control disable" type="number" placeholder="repeats"
                                                min="1" name="repeats" id="repeats" value="1" disabled
                                                data-set-disabled>
                                        </fieldset>
                                    </div>
                                </div> --}}

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
    </section>

</article>

<script>
    const date_start = document.getElementById('start_date')
    const date_end = document.getElementById('end_date')
    const duration = document.getElementById('duration')
    const now = new Date()

    duration.addEventListener('change', () => {
        date_end.value = add_Date(date_start.value, duration.value)
    })

    date_start.addEventListener('change', () => {
        if(date_start.value > date_end.value){
            date_end.value = add_Date(date_start.value, duration.value)
        }
    })
    date_end.addEventListener('change', () => {
        if(date_start.value > date_end.value){
            date_start.value = subtract_Date(date_end.value, duration.value)
        }
    })

    function add_Date(begin, time_duration){

        let date = new Date(new Date(begin) - now.getTimezoneOffset() * 60000)

        time_duration = new Date(new Date("1970-01-01 " + time_duration) - now.getTimezoneOffset())
        date.setHours(date.getHours() + time_duration.getHours())

        date.setMinutes(date.getMinutes() + time_duration.getMinutes())

        date = date.toISOString().slice(0, 16)

        return date
    }
    function subtract_Date(end, time_duration){

    let date = new Date(new Date(end) - now.getTimezoneOffset() * 60000)

    time_duration = new Date("1970-01-01 " + time_duration)
    date.setHours(date.getHours() - time_duration.getHours())

    date.setMinutes(date.getMinutes() - time_duration.getMinutes())

    date = date.toISOString().slice(0, 16)

    return date
    }

function duration(begin, end){

    let date = new Date(new Date(end) - now.getTimezoneOffset() * 60000)

    time_duration = new Date("1970-01-01 " + time_duration)
    date.setHours(date.getHours() - time_duration.getHours())

    date.setMinutes(date.getMinutes() - time_duration.getMinutes())

    date = date.toISOString().slice(0, 16)

    return date
    }
</script>
@endsection
