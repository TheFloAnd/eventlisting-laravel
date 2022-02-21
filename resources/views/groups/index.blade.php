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
    <section class="col-12">
        <div class="card">
            <div class="card-body">

                <nav>
                    <div class="nav nav-tabs justify-content-evenly" id="nav-tab" role="tablist">
                        <button class="nav-link col active" id="nav-active_group-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-active_group" type="button" role="tab" aria-controls="nav-active_group"
                            aria-selected="true">
                            {{ __('Aktive Gruppen') }}
                        </button>
                        <button class="nav-link col" id="nav-deactivated_group-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-deactivated_group" type="button" role="tab"
                            aria-controls="nav-deactivated_group" aria-selected="false">
                            {{ __('Inaktive Gruppen') }}
                        </button>
                    </div>
                </nav>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="nav-active_group" role="tabpanel"
                        aria-labelledby="nav-active_group-tab">
                        <div class="table-responsive mt-2">
                            <div class="my-2">
                                {{ __('Toggle') }}:
                                <a class="toggle-vis" data-column="2">
                                    {{ __('Farbe') }}
                                </a> -
                                <a class="toggle-vis" data-column="3">
                                    {{ __('Einstellung') }}
                                </a>
                            </div>
                            <table class="table dataTable_group_active table-striped table-hover mt-5"
                                id="table-to-refresh">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            {{ __('Alias') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Farbe') }}
                                        </th>
                                        <th class="no-sort" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($active as $row)
                                    <tr>
                                        <td class="table_search">{{ $row->alias }}</td>
                                        <td class="table_search">{{ $row->name }}</td>
                                        <td style="background-color:{{ $row->color }};">{{ $row->color }}</td>
                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Bearbeiten') }}">
                                            <a href="?b=group_edit&g={{ $row->alias }}" type="button"
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
                    <div class="tab-pane fade" id="nav-deactivated_group" role="tabpanel"
                        aria-labelledby="nav-deactivated_group-tab">
                        <div class="table-responsive mt-2">
                            <div class="my-2">
                                {{ __('Toggle') }}:
                                <a class="toggle-vis" data-column="2">
                                    {{ __('Farbe') }}
                                </a> -
                                <a class="toggle-vis" data-column="3">
                                    {{ __('Einstellung') }}
                                </a>
                            </div>
                            <table class="table dataTable_group_inactive table-striped table-hover"
                                id="table-to-refresh">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            {{ __('Alias') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col">
                                            {{ __('Farbe') }}
                                        </th>
                                        <th class="no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inactive as $row)
                                    <tr>
                                        <td class="table_search">{{ $row->alias }}</td>
                                        <td class="table_search">{{ $row->name }}</td>
                                        <td style="background-color:{{ $row->color }};">{{ $row->color }}</td>
                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Bearbeiten') }}">
                                            <a href="?b=group_edit&g={{ $row->alias }}" type="button"
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
            </div>
        </div>
    </section>

</article>
@endsection
