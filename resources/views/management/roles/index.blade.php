@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))
<x-alert type="success" :message="$message" />
@endif
<article class="row g-3">
    <section class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
            @can('user-create')
            <div class="col-lg-4">
                <a class="btn btn-md btn-rounded btn-outline-success w-100" href="{{ route('roles.create') }}">
                    {{ __('Hinzufügen') }}
                </a>
            </div>
            @endcan
        </div>

        <x-breadcrumb :breadcrumb="[
                                            ['Rolen', 'roles.index'],
                                        ]" />
    </section>
    <section class="col-lg-12 accordion" id="collapse-table">
        <div class="card accordion-item">
            <div class="card-header accordion-header accordion__header" id="collapse-table-head" style="height: 2rem;"
                data-toggle="collapse" data-target="#collapse-table-body" aria-controls="collapse-table-body">
                <h4 class="card-title mr-auto pull-left">{{ __('Vergangene Einträge') }}</h4>
                <span class="accordion__header--indicator"></span>
            </div>
            <div class="card-body collapse accordion-body show" id="collapse-table-body"
                data-bs-parent="#collapse-table">
                <div class="table-responsive">
                    <table class="dataTable_default stripe display row-border hover order-column compact"
                        class="display" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th style="width:7.5em;">{{ __('Aktion') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-primary shadow sharp mr-1"
                                        href="{{ route('roles.show',[$role->id, $role->name]) }}">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg></i>
                                    </a>
                                    @can('role-edit')
                                    <a href="{{ route('roles.edit',[$role->id, $role->name]) }}"
                                        class="btn btn-success shadow sharp">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg></i>
                                    </a>
                                    @endcan
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

{!! $roles->render() !!}

@endsection
