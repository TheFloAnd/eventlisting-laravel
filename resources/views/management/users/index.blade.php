@extends('layouts.app')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="form-head d-flex mb-0 align-items-start">
            <div class="mr-auto">
                <h2 class="text-black font-w600 mb-0">
                    {{ $title ?? '' }}
                </h2>
            </div>
            <div class="pull-right">
                @can('user-create')
                <a class="btn btn-md btn-rounded btn-outline-success" href="{{ route('users.create') }}">
                    {{ __('Neuer Benutzer') }}
                </a>
                @endcan
            </div>
        </div>
    </div>



    <x-breadcrumb :breadcrumb="[
                                ['Benutzer', 'users.index'],
                            ]" />


    @if ($message = Session::get('success'))
    <x-alert.success :message="$message" />
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="dataTable_default stripe display row-border hover order-column compact"
                            class="display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{ __('Rolle') }}</th>
                                    <th style="width:5em;">{{ __('Aktion') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <a href="javascript:void(0);">
                                            <strong>
                                                {{ $user->email }}
                                            </strong>
                                        </a>
                                    </td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                        @switch(TRUE)
                                        @case(stristr($v,'admin'))
                                        <label class="badge badge-rounded badge-outline-danger table_search">{{
                                            $v }}</label>
                                        @break
                                        @case(stristr($v,'user'))
                                        <label class="badge badge-rounded badge-outline-primary table_search">{{
                                            $v }}</label>
                                        @break
                                        @default
                                        <label class="badge badge-rounded badge-outline-secondary table_search">{{
                                            $v }}</label>
                                        @endswitch
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('users.show',[$user->id, $user->name]) }}"
                                                class="btn btn-primary shadow sharp mr-1">
                                                <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg></i>
                                            </a>
                                            @can('user-edit')
                                            @if($user->hasRole(['administrator', 'moderator']))
                                            @hasrole('administrator')
                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                class="btn btn-success shadow sharp">
                                                <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                </svg></i>

                                            </a>
                                            @endhasrole
                                            @else
                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                class="btn btn-success shadow sharp">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                </svg>
                                            </a>
                                            @endif
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{-- {!! $data->render() !!} --}}

        @endsection
