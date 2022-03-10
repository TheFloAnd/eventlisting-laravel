@extends('layouts.app')

@section('content')
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
                            {{ __('Farbe') }}
                        </a> -
                        <a class="toggle-vis" data-column="3">
                            {{ __('Einstellung') }}
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
                                @if(date('d.m.Y', strtotime($row->start)) != date('d.m.Y',
                                strtotime($row->end)))

                                @if(date('H:i', strtotime($row->start)) == '00:00')
                                <td> {{ date('D - d.m.Y', strtotime($row->start)) }} </td>
                                @else
                                <td> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }} </td>
                                @endif

                                @if(date('H:i', strtotime($row->end)) == '00:00')
                                <td> {{ date('D - d.m.Y', strtotime($row->end)) }} </td>
                                @else
                                <td> {{ date('D - d.m.Y - H:i', strtotime($row->end))}} </td>
                                @endif

                                @endif
                                @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                strtotime($row->end)))

                                @if(date('H:i', strtotime($row->start)) == date('H:i',
                                strtotime($row->end)))

                                @if(date('H:i', strtotime($row->start)) == '00:00')
                                <td colspan="2"> {{ date('D - d.m.Y - H:i', strtotime($row->start)) }}
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
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Bearbeiten') }}">
                                    <a href="{{ route('events.edit', $row->id) }}" type="button"
                                        class="btn btn-sm btn-secondary position-relative">
                                        <i class="bi bi-gear-wide"></i>
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
