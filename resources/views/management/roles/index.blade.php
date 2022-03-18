@extends('layouts.app')


@section('content')
<div class="container-fluid">

    <x-page_title :title="$title" :route="'roles.create'" :icon="'user-tag'" :add="'1'" :btn_txt="'Rolle Erstellen'" />

    <x-breadcrumb :breadcrumb="[
                                ['Rollen', 'roles.index'],
                            ]" />

    @if ($message = Session::get('success'))
    <x-alert.success :message="$message" />
    @endif
    <div class="row">
        <div class="col-lg-12 accordion" id="collapse-table">
            <div class="card accordion-item">
                <div class="card-header accordion-header accordion__header" id="collapse-table-head"
                    style="height: 2rem;" data-toggle="collapse" data-target="#collapse-table-body"
                    aria-controls="collapse-table-body">
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
                                    <th style="width:5em;">{{ __('Name') }}</th>
                                    <th style="width:5em;">{{ __('Aktion') }}</th>
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
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('role-edit')
                                        <a href="{{ route('roles.edit',[$role->id, $role->name]) }}"
                                            class="btn btn-success shadow sharp">
                                            <i class="fas fa-edit"></i>
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
        </div>
    </div>

    {!! $roles->render() !!}

    @endsection
