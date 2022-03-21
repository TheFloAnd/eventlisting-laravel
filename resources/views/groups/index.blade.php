@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))
<x-alert type="success" :message="$message" />
@endif
@if($message = Session::get('warning'))
<x-alert type="warning" :message="$message" />
@endif

<x-breadcrumb :breadcrumb="[
                                    ['Gruppen', 'groups'],
                                ]" />

<article class="row g-3">
    <section class="col-12">
        <div class="d-flex justify-content-end mx-2">
            <a href="{{ route('groups.create') }}" type="button" class="btn btn-outline-success w-100">
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
                                        <td class="group_color" style="background-color:{{ $row->color }};">{{ $row->color }}</td>
                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Bearbeiten') }}">
                                            <a href="{{ route('groups.edit', $row->alias) }}" type="button"
                                                class="btn btn-sm btn-secondary position-relative">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                                                </svg>
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
                                        <td class="group_color" style="background-color:{{ $row->color }};">{{ $row->color }}</td>
                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Bearbeiten') }}">
                                            <a href="{{ route('groups.edit', $row->alias) }}" type="button"
                                                class="btn btn-sm btn-secondary position-relative">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                                                </svg>
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
