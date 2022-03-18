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


        {{-- <x-breadcrumb :breadcrumb="[
                                ['Benutzer', 'users.index'],
                            ]"/> --}}


        @if ($message = Session::get('success'))
            <x-alert.success :message="$message"/>
        @endif


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item w-50">
                                    <a class="nav-link active" data-toggle="tab" href="#user">
                                        <i class="fas fa-users mr-2"></i>
                                        {{ __('Benutzer') }}
                                    </a>
                                </li>
                                <li class="nav-item w-50">
                                    <a class="nav-link" data-toggle="tab" href="#blocked">
                                        <i class="fas fa-user-lock mr-2"></i>
                                        {{ __('Gespeerte Benutzer') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="user" role="tabpanel">
                                    <div class="pt-4">
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
                                                    @if(!$user->blocked_at)
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
                                                                            <label class="badge badge-rounded badge-outline-danger table_search">{{ $v }}</label>
                                                                            @break
                                                                            @case(stristr($v,'user'))
                                                                            <label class="badge badge-rounded badge-outline-primary table_search">{{ $v }}</label>
                                                                            @break
                                                                            @default
                                                                            <label class="badge badge-rounded badge-outline-secondary table_search">{{ $v }}</label>
                                                                        @endswitch
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('users.show',[$user->id, $user->name]) }}"
                                                                       class="btn btn-primary shadow sharp mr-1">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    @can('user-edit')
                                                                        @if($user->hasRole(['administrator', 'moderator']))
                                                                            @hasrole('administrator')
                                                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                                               class="btn btn-success shadow sharp">
                                                                                <i class="fas fa-user-edit"></i>
                                                                            </a>
                                                                            @endhasrole
                                                                        @else
                                                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                                               class="btn btn-success shadow sharp">
                                                                                <i class="fas fa-user-edit"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="blocked">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table class="dataTable_default stripe display row-border hover order-column compact"
                                                   class="display" style="width:100%;">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('E-Mail') }}</th>
                                                    <th>{{ __('Rolle') }}</th>
                                                    <th>{{ __('Gesperrt') }}</th>
                                                    <th style="width:5em;">{{ __('Aktion') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($data as $key => $user)
                                                    @if($user->blocked_at)
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
                                                                            <label class="badge badge-rounded badge-outline-danger table_search">{{ $v }}</label>
                                                                            @break
                                                                            @case(stristr($v,'user'))
                                                                            <label class="badge badge-rounded badge-outline-primary table_search">{{ $v }}</label>
                                                                            @break
                                                                            @default
                                                                            <label class="badge badge-rounded badge-outline-secondary table_search">{{ $v }}</label>
                                                                        @endswitch
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(empty($user->blocked_at))
                                                                    <label class="badge badge-rounded badge-outline-success">
                                                                        {{ __('Nicht Gesperrt') }}
                                                                    </label>
                                                                @else
                                                                    <label class="badge badge-rounded badge-outline-danger">
                                                                        {{ $user->blocked_at }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('users.show', [$user->id, $user->name]) }}"
                                                                       class="btn btn-primary shadow sharp mr-1">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    @can('user-edit')
                                                                        @if($user->hasRole(['administrator', 'moderator']))
                                                                            @hasrole('administrator')
                                                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                                               class="btn btn-success shadow sharp">
                                                                                <i class="fas fa-user-edit"></i>
                                                                            </a>
                                                                            @endhasrole
                                                                        @else
                                                                            <a href="{{ route('users.edit', [$user->id, $user->name]) }}"
                                                                               class="btn btn-success shadow sharp">
                                                                                <i class="fas fa-user-edit"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    {{-- {!! $data->render() !!} --}}

@endsection
