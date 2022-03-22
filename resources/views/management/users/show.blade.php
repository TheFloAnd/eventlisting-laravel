@extends('layouts.app')


@section('content')
<article class="row g-3">
    <section class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('users.index') }}" type="button" class="btn btn-outline-secondary w-100">
                    {{ __('Zurück') }}
                </a>
            </div>
        </div>

        <x-breadcrumb :breadcrumb="[
                                    [__('Benutzer'), 'users.index'],
                                    [__($user->name), 'users.show', [$user->id, $user->name]],
                                ]" />
    </section>
    <section class="col-md-10 col-md-11 col-lg-10">
        <div class="card">
            @can('user-edit')
            <div class="card-header justify-content-center">
                <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                    href="{{ route('users.edit', [$user->id, $user->name]) }}">
                    {{ __('Bearbeiten') }}
                </a>
            </div>
            @endcan
            <div class="card-body">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <!-- <h4>{{ __('Name:') }}</h4> -->
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                            <label for="name">
                                Name
                                <strong style="color:red;">*</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <!-- <h4>{{ __('Email-Adresse:') }}</h4> -->
                            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                            <label for="email">
                                E-Mail Adresse
                                <strong style="color:red;">*</strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-11 col-lg-10">
                        <div class="form-group">
                            <h4>{{ __('Role:') }}</h4>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            @switch(TRUE)
                            @case(stristr($v,'admin'))
                            <label class="badge badge-md badge-pill badge-outline-danger">
                                {{ $v }}
                            </label>
                            @break
                            @case(stristr($v,'user'))
                            <label class="badge badge-md badge-pill badge-outline-primary">
                                {{ $v }}
                            </label>
                            @break
                            @default
                            <label class="badge badge-md badge-pill badge-outline-secondary">
                                {{ $v }}
                            </label>
                            @endswitch
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @if(!empty($user->blocked_at))
                    <div class="col-md-11 col-lg-10">
                        <div class="form-floating">
                            <h4>{{ __('Gesperrt:') }}</h4>
                            <label class="badge badge-md badge-pill badge-outline-danger">
                                {{ $user->blocked_at }}
                            </label>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <div class="row g-3 justify-content-center">
                    <div class="col-8">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success w-100" name="submit_event"
                                value="{{ __('Ändern') }}">
                                {{ __('Ändern') }}
                            </button>
                        </div>
                    </div>
                    @if(!$user->hasRole(['administrator']))
                    <div class="col-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-outline-danger w-100" name="submit_event"
                                value="{{ __('Löschen') }}" data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                {{ __('Löschen') }}
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</article>
@if(!$user->hasRole(['administrator']))
<div class="modal fade" id="Modal_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Löschen') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Wollen sie den Benutzer wirklich Löschen?') }}
            </div>
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                @method('delete')
                @csrf
                <div class="modal-footer">
                    <button type="submit" value="reactivate" name="reactivate"
                        class="btn btn-md btn-rounded btn-outline-danger w-100">
                        {{ __('Löschen') }}
                    </button>
                    <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100"
                        data-dismiss="modal">
                        Schließen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif
@endsection
