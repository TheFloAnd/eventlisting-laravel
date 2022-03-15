@extends('layouts.app')

@section('content')

@if($errors->any())
@foreach ($errors->all() as $error)
<x-alert.error :message="$error" />
@endforeach
@endif

<article class="row g-3">
    <section>
        <h1>
            {{ $title }}
        </h1>
    </section>
    <section class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('groups.store') }}">
                    @csrf
                    <div class="row mt-3 g-3 justify-content-center">
                        <div class="col-md-10">
                            <fieldset>
                                <div class="form-floating has-validation">
                                    <input type="text" class="form-control @error(__('GruppenName')) is-invalid @enderror"
                                        name="{{__('GruppenName')}}" id="{{__('GruppenName')}}"
                                        placeholder="{{ old(__('GruppenName')) ?? __('Gruppen Name') }}" maxlength="100"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Die volle Bezeichnung für die Gruppe') }}" data-show-input-length>
                                    <label for="{{__('GruppenName')}}">
                                        {{ __('Gruppen Name') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="{{__('GruppenName')}}_label" class="label"></span>
                                    </label>
                                    @error(__('GruppenName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-8">
                            <fieldset>
                                <div class="form-floating">
                                    <input type="text" class="form-control @error(__('GruppenAlias')) is-invalid @enderror"
                                        name={{ __('GruppenAlias') }} id={{ __('GruppenAlias') }}
                                        placeholder="{{ old(__('GruppenAlias')) ?? __('GruppenAlias') }}" maxlength="10"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ __('Ein Kürzel für die Gruppe') }}" data-show-input-length>
                                    <label for={{ __('GruppenAlias') }}>
                                        {{ __('Gruppen Alias') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                        <span id="{{__('GruppenAlias')}}_label" class="label"></span>
                                    </label>
                                    @error(__('GruppenAlias'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-md-2">
                            <fieldset>
                                <div class="form-group">
                                    <label for="floatingInput">
                                        {{ __('Gruppen Farbe') }}
                                        <span style="color: red;">
                                            *
                                        </span>
                                    </label>
                                    <input type="color" class="form-control form-control-color" name={{__('GruppenFarbe')}}
                                        id={{__('GruppenFarbe')}} value="{{ old(__('GruppenFarbe')) ?? $color }}" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="
                                    {{ __('Darstellungs Farbe für die Gruppe!') }}">
                                    @error(__('GruppenFarbe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100" name="submit_group"
                                    value="{{ __('Hinzufügen') }}">
                                    {{ __('Hinzufügen') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <a type="button" class="btn btn-outline-secondary w-100"
                                    href="{{ route('groups') }}">
                                    {{ __('Zurück') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</article>
@endsection
