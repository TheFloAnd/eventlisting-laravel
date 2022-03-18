@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))
<x-alert.success :message="$message" />
@endif
@if($message = Session::get('warning'))
<x-alert.warning :message="$message" />
@endif
<x-breadcrumb :breadcrumb="[
                                    ['Termine', 'events'],
                                ]" />
<article class="row g-3">
    <section class="col-12">
        <div class="d-flex justify-content-end mx-2">
            <a href="{{ route('events.create') }}" type="button" class="btn btn-outline-success w-100">
                {{ __('Hinzufügen') }}
            </a>
        </div>
    </section>

    <!-- Auflistung -->
    <section class="col-12 events-section">
        <div class="card events-card">
            <div class="card-body" id="refresh-event-card" data-refresh>
                <div class="table-responsive">
                    <div class="my-2">
                        {{ __('Toggle') }}:
                        <a class="toggle-vis" data-column="2">
                            {{ __('Raum') }}
                        </a> -
                        <a class="toggle-vis" data-column="5">
                            {{ __('In') }}
                        </a> -
                        <a class="toggle-vis" data-column="6">
                            {{ __('Ändern') }}
                        </a>
                    </div>
                    <table class="table dataTable dataTable_default table-striped table-hover">
                        <thead class="events-card-table-head">
                            <tr>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('Termin') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('Gruppe(n)') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('Raum') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('Von') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('Bis') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">
                                    {{ __('In') }}
                                </th>
                                <th scope="col" class="home-card-preview-table-head-item">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="events-card-table-body">

                            @forEach($data as $row)
                            @if($row->not_applicable == 1)
                            <tr class="table-danger strikethrough">
                                @else
                            <tr>
                                @endif
                                <td>
                                    {{ $row->event }}
                                </td>
                                {{-- <td>
                                    @foreach(explode(';', $row->team) as $group)
                                    <span class="badge rounded-pill text-dark"
                                        style="background-color:{{ App\Models\Groups::alias($group)->pluck('color')->first() }};">
                                        {{ $group }}
                                    </span>
                                    @endforeach
                                </td> --}}
                                <td>
                                    @foreach(explode(';', $row->team) as $group)
                                    @forEach($groups as $get_color)
                                    @if($get_color->alias == $group)
                                    <span class="badge rounded-pill text-dark" style="background-color:{{ $get_color->color }};">

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
                                <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                @else
                                <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                @endif

                                @if(date('H:i', strtotime($row->end)) == '00:00')
                                <td> {{ date('d.m.Y', strtotime($row->end)) }} </td>
                                @else
                                <td> {{ date('d.m.Y - H:i', strtotime($row->end))}} </td>
                                @endif

                                @endif
                                @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                strtotime($row->end)))

                                @if(date('H:i', strtotime($row->start)) == date('H:i',
                                strtotime($row->end)))

                                @if(date('H:i', strtotime($row->start)) == '00:00')
                                <td colspan="2"> {{ date('d.m.Y - H:i', strtotime($row->start)) }}
                                </td>
                                <td style="display:none;">
                                    @else
                                <td colspan="2"> {{ date('d.m.Y - H:i', strtotime($row->start))
                                    }} </td>
                                <td style="display:none;">
                                    @endif

                                    @endif
                                    @if(date('H:i', strtotime($row->start)) != date('H:i',
                                    strtotime($row->end)))

                                    @if(date('H:i', strtotime($row->start)) == '00:00')
                                <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                @else
                                <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                @endif

                                @if(date('H:i', strtotime($row->end)) == '00:00')
                                <td> {{ date('d.m.Y', strtotime($row->end)) }} </td>
                                @else
                                <td> {{ date('H:i', strtotime($row->end)) }} </td>
                                @endif
                                @endif
                                @endif

                                <td>
                                    {{ abs(strtotime(date('Y-m-d', strtotime($row->start))) -
                                    strtotime(date("Y-m-d"))) / 60 / 60 / 24 }}
                                    {{ __('Tagen') }}
                                </td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Bearbeiten') }}">
                                    <a href="{{ route('events.edit', $row->id) }}" type="button"
                                        class="btn btn-sm btn-secondary position-relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                            <path
                                                d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                                        </svg>
                                        {{-- <i class="bi bi-gear-wide"></i> --}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</article>
@endsection
