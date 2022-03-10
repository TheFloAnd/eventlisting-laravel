@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('events.store') }}">
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
                    <a href="#" type="button" class="btn btn-outline-secondary w-100">
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
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('event') is-invalid @enderror"
                                        name="event" id="event" placeholder="{{ $result->event ?? old('event') }}"
                                        value="{{ $result->event ?? old('event') }}" list="event_list" maxlength="50"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Termin Name') }}" data-show-input-length>
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
                                                title="{{ __('An dem Termin Teilnehmende Gruppen') }}">
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
                                    <input type="datetime-local"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        id="start_date"
                                        value="{{ date('Y-m-d\T00:00', strtotime($result->start)) ?? date('Y-m-d\T00:00') }}"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
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
                        <div class="col-md-5">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="datetime-local"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        id="end_date"
                                        value="{{ date('Y-m-d\T00:00', strtotime($result->end)) ?? date('Y-m-d\T00:00') }}"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
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
                            <div class="row g-3 mb-3" data-disable-area>
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
                                    value="{{ __('Hinzufügen') }}">
                                    {{ __('Hinzufügen') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="col-12 home-section-today">
            <div class="card home-card-today">
                <div class="card-header home-card-header home-card-today-header">
                    <nav class="navbar home-card-today-header-nav">
                        <div class="row home-card-today-header-row">
                            <div class="col-auto home-card-today-header-col">
                                <div id="refresh-title" data-refresh>
                                    <h1 class="header-primary">
                                        {{ __('Folgende Termine') }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="card-body home-card-body home-card-today-body" id="refresh-home-card" data-refresh>
                    <div class="table-responsive">
                        <table class="table table-striped home-card-today-body-table">
                            <thead class="home-card-today-table-head">
                                <tr>
                                    <th scope="col" class="home-card-today-table-head-item">
                                        {{ __('Termin') }}
                                    </th>
                                    <th scope="col" class="home-card-today-table-head-item">
                                        {{ __('Gruppe') }}
                                    </th>
                                    <th scope="col" class="home-card-today-table-head-item">
                                        {{ __('Raum') }}
                                    </th>
                                    <th scope="col" class="home-card-today-table-head-item">
                                        {{ __('Von') }}
                                    </th>
                                    <th scope="col" class="home-card-today-table-head-item">
                                        {{ __('Bis') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="home-card-today-table-body">

                                @forEach($result_future as $row)
                                @if($row->not_applicable == 1)
                                <tr class="table-danger strikethrough">
                                    @else
                                <tr>
                                    @endif
                                    <td>
                                        {{ $row->event }}
                                    </td>
                                    <td>
                                        @foreach(explode(';', $row->team) as $group)
                                        <span class="badge text-dark"
                                            style="background-color:{{ App\Models\Groups::alias($group)->pluck('color')->first() }};">
                                            {{-- <span class="badge"> --}}
                                                {{ $group }}
                                            </span>
                                            @endforeach
                                    </td>
                                    <td>
                                        {{ $row->room }}
                                    </td>
                                    @if(strftime('%d.%m.%Y', strtotime($row->start)) != strftime('%d.%m.%Y',
                                    strtotime($row->end)))

                                    @if(strftime('%H:%M', strtotime($row->start)) == '00:00')
                                    <td> {{ strftime('%a - %d.%m.%Y', strtotime($row->start)) }} </td>
                                    @else
                                    <td> {{ strftime('%a - %d.%m.%Y - %H:%M', strtotime($row->start)) }} </td>
                                    @endif

                                    @if(strftime('%H:%M', strtotime($row->end)) == '00:00')
                                    <td> {{ strftime('%a - %d.%m.%Y ', strtotime($row->end)) }} </td>
                                    @else
                                    <td> {{ strftime('%a - %d.%m.%Y - %H:%M', strtotime($row->end))}} </td>
                                    @endif

                                    @endif
                                    @if(strftime('%d.%m.%Y', strtotime($row->start)) == strftime('%d.%m.%Y',
                                    strtotime($row->end)))

                                    @if(strftime('%H:%M', strtotime($row->start)) == strftime('%H:%M',
                                    strtotime($row->end)))

                                    @if(strftime('%H:%M', strtotime($row->start)) == '00:00')
                                    <td colspan="2"> {{ strftime('%a - %d.%m.%Y ', strtotime($row->start)) }}
                                    </td>
                                    <td style="display:none;">
                                        @else
                                    <td colspan="2"> {{ strftime('%a - %d.%m.%Y - %H:%M', strtotime($row->start))
                                        }} </td>
                                    <td style="display:none;">
                                        @endif

                                        @endif
                                        @if(strftime('%H:%M', strtotime($row->start)) != strftime('%H:%M',
                                        strtotime($row->end)))

                                        @if(strftime('%H:%M', strtotime($row->start)) == '00:00')
                                    <td> {{ strftime('%a - %d.%m.%Y', strtotime($row->start)) }} </td>
                                    @else
                                    <td> {{ strftime('%a - %d.%m.%Y - %H:%M', strtotime($row->start)) }} </td>
                                    @endif

                                    @if(strftime('%H:%M', strtotime($row->end)) == '00:00')
                                    <td> {{ strftime('%a - %d.%m.%Y', strtotime($row->end)) }} </td>
                                    @else
                                    <td> {{ strftime('%a - %H:%M', strtotime($row->end)) }} </td>
                                    @endif
                                    @endif
                                    @endif


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </article>
</form>
@endsection
