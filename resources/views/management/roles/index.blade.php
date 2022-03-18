@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <x-page_title :title="$title"
                      :route="'roles.create'"
                      :icon="'user-tag'"
                      :add="'1'"
                      :btn_txt="'Rolle Erstellen'"/>

        <x-breadcrumb :breadcrumb="[
                                ['Rollen', 'roles.index'],
                            ]"/>

        @if ($message = Session::get('success'))
            <x-alert.success :message="$message"/>
        @endif

        @include('components.table.head', ['class' => 'dataTable_default', 'column_head' => ['Name']])
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
    @include('components.table.foot')

    {!! $roles->render() !!}

@endsection
