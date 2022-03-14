@extends('layouts.app')

@section('content')
@php
if($result->not_applicable == 1){
$disabled = 'disabled';
$checked = 'checked';
}else{
$disabled = '';
$checked = '';
}
@endphp

<form method="post" action="{{ route('events.update', $result->id) }}">
    @method('patch')
    @csrf
    <article class="row g-3">
        <div class="col-12">
            <div class="row d-flex align-content-center">
                <div class="col-md-8">
                    <h1>
                        {{ $title }}
                    </h1>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('events') }}" type="button" class="btn btn-outline-secondary w-100">
                        {{ __('Zurück') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- Auflistung -->
        <section class="col-12 events-section">
            <div class="card events-card">
                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        <div class="col-12">
                            <fieldset>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="not_applicable"
                                            id="not_applicable" data-toggle="toggle" autocomplete="off"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Den Termin als Enfällt zu setzen') }}" data-toggle-disable {{
                                            $checked }}>
                                        <label class="form-check-label" for="not_applicable">
                                            {{ __('Entfällt') }}
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center" data-area="disable">
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('event') is-invalid @enderror"
                                        name="event" id="event" placeholder="{{ $result->event ?? old('event') }}"
                                        value="{{ $result->event ?? old('event') }}" list="event_list" maxlength="50"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Termin Name') }}" data-show-input-length data-set-disabled {{
                                        $disabled }}>
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
                                                title="{{ __('An dem Termin Teilnehmende Gruppen') }}" data-set-disabled
                                                {{ $disabled }}>
                                                @foreach ($groups as $row)
                                                @if(in_array($row->alias, explode(';', $result->team)))
                                                <option value="{{ $row->alias }}" selected>{{ $row->name }} ({{
                                                    $row->alias }})
                                                </option>
                                                @endif
                                                @if(!in_array($row->alias, explode(';', $result->team)))
                                                <option value="{{ $row->alias }}">{{ $row->name }} ({{
                                                    $row->alias }})
                                                </option>
                                                @endif
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
                                            <input type="text" class="form-control @error('room') is-invalid @enderror"
                                                name="room" id="room" placeholder="{{ $result->room ?? old('room') }}"
                                                value="{{ $result->room ?? old('room') }}" list="room_list"
                                                maxlength="25" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Raum wo der Termin stattfindet') }}"
                                                data-show-input-length data-set-disabled {{ $disabled }}>
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
                                    <input type="datetime-local"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        id="start_date"
                                        value="{{ date('Y-m-d\T00:00', strtotime($result->start)) ?? date('Y-m-d\T00:00') }}"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Datum/Zeit wann der Termin Startet.') }}" data-set-disabled {{
                                        $disabled }}>
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
                        <div class="col-md-5">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        id="end_date"
                                        value="{{ date('Y-m-d\T00:00', strtotime($result->end)) ?? date('Y-m-d\T00:00') }}"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Datum/Zeit wann der Termin Endet.') }}" data-set-disabled {{
                                        $disabled }}>
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

                    {{--
                    <hr class="separator">

                    <div class="row g-3 justify-content-center">
                        <div class="col-md-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="repeat" name="repeat"
                                    data-toggle-disable>
                                <label class="form-check-label" for="repeat">{{ __('Wiederholen') }}</label>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row g-3 mb-3" data-area="disable">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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
                            </div>
                        </div>
                    </div> --}}

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
                        <div class="col-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-danger w-100" name="submit_event"
                                    value="{{ __('Löschen') }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    {{ __('Löschen') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($result_future != NULL)
        <section class="col-12 home-section-today">
            <div class="card home-card-today">
                <div class="card-header">
                    <nav class="navbar">
                        <div class="row">
                            <div class="col-auto">
                                <div>
                                    <h1 class="header-primary">
                                        {{ __('Folgende Termine') }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <fieldset>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="edit_repeat"
                                            id="edit_repeat" data-toggle="toggle" autocomplete="off"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Aktivieren um das Ändern von Folgenden Terminen zu Aktivieren.') }}"
                                            data-toggle-disable>
                                        <label class="form-check-label" for="edit_repeat">
                                            {{ __('Wiederholungen ändern?') }}
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row g-3" data-area="disable" data-area-select>
                        <div class="col-12">
                            <fieldset>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="select_all"
                                            data-toggle="toggle" autocomplete="off" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ __('Alle Auswählen.') }}"
                                            data-set-disabled disabled data-toggle-select>
                                        <label class="form-check-label" for="select_all">
                                            {{ __('Alle Auswählen.') }}
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>

                                            </th>
                                            <th scope="col">
                                                {{ __('Termin') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Gruppe') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Raum') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Von') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Bis') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('In') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forEach($result_future as $row)
                                        @if($row->id != $result->id)
                                        @if($row->not_applicable == 1)
                                        <tr class="table-danger strikethrough">
                                            @else
                                        <tr>
                                            @endif
                                            <td>
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="followng_event[]" value="{{ $row->id }}"
                                                                data-toggle="toggle" autocomplete="off"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('Den Termin zum Ändern Auswählen') }}"
                                                                data-set-disabled data-set-select disabled>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </td>
                                            <td>
                                                {{ $row->event }}
                                            </td>
                                            <td>
                                                @foreach(explode(';', $row->team) as $group)
                                                @forEach($groups as $get_color)
                                                @if($get_color->alias == $group)
                                                <span class="badge rounded-pill text-dark"
                                                    style="background-color:{{ $get_color->color }};">

                                                    {{ $group }}
                                                </span>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $row->room }}
                                            </td>
                                            @if(date('d.m.Y', strtotime($row->start)) != date('d.m.Y',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->start)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }} </td>
                                            @endif

                                            @if(date('H:i', strtotime($row->end)) == '00:00')
                                            <td> {{ date('D - d.m.Y ', strtotime($row->end)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->end))}} </td>
                                            @endif

                                            @endif
                                            @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == date('H:i',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td colspan="2"> {{ date('D - d.m.Y ', strtotime($row->start)) }}
                                            </td>
                                            <td style="display:none;">
                                                @else
                                            <td colspan="2"> {{ date('D - d.m.Y - H:i', strtotime($row->start))
                                                }} </td>
                                            <td style="display:none;">
                                                @endif

                                                @endif
                                                @if(date('H:i', strtotime($row->start)) != date('H:i',
                                                strtotime($row->end)))

                                                @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->start)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }} </td>
                                            @endif

                                            @if(date('H:i', strtotime($row->end)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->end)) }} </td>
                                            @else
                                            <td> {{ date('D - H:i', strtotime($row->end)) }} </td>
                                            @endif
                                            @endif
                                            @endif
                                            <td>
                                                {{ abs(strtotime(date('Y-m-d', strtotime($row->start))) -
                                                strtotime(date("Y-m-d"))) / 60 / 60 / 24 }}
                                                {{ __('Tagen') }}
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

    </article>
</form>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    {{ __('Löschen') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('events.destroy', $result->id) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>{{ __('Wollen die den Termin wirklich Löschen?') }}</p>
                    <hr class="separator">
                    <div class="row g-3">
                        <div class="col-12">
                            <fieldset>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="delete_repeat"
                                            id="delete_repeat" data-toggle="toggle" autocomplete="off"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Aktivieren um das Löschen von Folgenden Terminen zu Aktivieren.') }}"
                                            data-toggle-disable>
                                        <label class="form-check-label" for="delete_repeat">
                                            {{ __('Wiederholungen Löschen?') }}
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row g-3" data-area="disable" data-area-select>
                        <div class="col-12">
                            <fieldset>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="select_all"
                                            data-toggle="toggle" autocomplete="off" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="{{ __('Alle Auswählen.') }}"
                                            data-set-disabled disabled data-toggle-select>
                                        <label class="form-check-label" for="select_all">
                                            {{ __('Alle Auswählen.') }}
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive del_following_events">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                {{ __('Auswahl') }}
                                            </th>
                                            <th scope="col" class="">
                                                {{ __('Termin') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Von') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('Bis') }}
                                            </th>
                                            <th scope="col">
                                                {{ __('In') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forEach($result_future as $row)
                                        @if($row->id != $result->id)
                                        @if($row->not_applicable == 1)
                                        <tr class="table-danger strikethrough">
                                            @else
                                        <tr>
                                            @endif
                                            <td class="table-select-col">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="followng_event[]" value="{{ $row->id }}"
                                                                data-toggle="toggle" autocomplete="off"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('Den Termin zum Ändern Auswählen') }}"
                                                                data-set-disabled data-set-select disabled>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </td>
                                            <td>
                                                {{ $row->event }}
                                            </td>
                                            @if(date('d.m.Y', strtotime($row->start)) != date('d.m.Y',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->start)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }} </td>
                                            @endif

                                            @if(date('H:i', strtotime($row->end)) == '00:00')
                                            <td> {{ date('D - d.m.Y ', strtotime($row->end)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->end))}} </td>
                                            @endif

                                            @endif
                                            @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == date('H:i',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td colspan="2"> {{ date('D - d.m.Y ', strtotime($row->start)) }}
                                            </td>
                                            <td style="display:none;">
                                                @else
                                            <td colspan="2"> {{ date('D - d.m.Y - H:i', strtotime($row->start))
                                                }} </td>
                                            <td style="display:none;">
                                                @endif

                                                @endif
                                                @if(date('H:i', strtotime($row->start)) != date('H:i',
                                                strtotime($row->end)))

                                                @if(date('H:i', strtotime($row->start)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->start)) }} </td>
                                            @else
                                            <td> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }} </td>
                                            @endif

                                            @if(date('H:i', strtotime($row->end)) == '00:00')
                                            <td> {{ date('D - d.m.Y', strtotime($row->end)) }} </td>
                                            @else
                                            <td> {{ date('D - H:i', strtotime($row->end)) }} </td>
                                            @endif
                                            @endif
                                            @endif
                                            <td>
                                                {{ abs(strtotime(date('Y-m-d', strtotime($row->start))) -
                                                strtotime(date("Y-m-d"))) / 60 / 60 / 24 }}
                                                {{ __('Tagen') }}
                                            </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Schließen') }}
                    </button>
                    <button type="submit" class="btn btn-danger" name="submit_delete_event">
                        {{ __('Löschen') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
