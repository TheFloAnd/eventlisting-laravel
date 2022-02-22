@extends('layouts.app')

@section('content')
<article class="row g-3">
    <section class="col-12">
        <div class="d-flex justify-content-end mx-2">
            <a href="#" type="button" class="btn btn-outline-success w-100">
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
                                    <span class="badge text-dark" style="background-color:{{ App\Models\Groups::alias($group)->pluck('color')->first() }};">
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

                                <td>
                                    {{ abs(strtotime(strftime('%Y-%m-%d', strtotime($row->start))) -
                                    strtotime(strftime('%Y-%m-%d'))) / 60 / 60 / 24 }}
                                    {{ __('Tagen') }}
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
