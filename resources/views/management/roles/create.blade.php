@extends('layouts.app')


@section('content')

    <div class="container-fluid">

        <x-page_title :title="$title"
                      :route="'drink.create'"
                      :icon="'user-tag'"/>

        <x-breadcrumb :breadcrumb="[
                                ['Rollen', 'roles.index'],
                                ['Rollen Hinzufügen', 'roles.create'],
                            ]"/>

        {{-- @if (count($errors) > 0)
            <x-alert.error_input :errors="$errors" />
        @endif --}}

        <div class="row d-flex justify-content-center">
            <div class="col-md-11 col-lg-10">
                <div class="card">
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-11 col-lg-10">
                                <div class="form-group">
                                    <h4>Name:</h4>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-group">
                                    <h4>Berechtigungen:</h4>
                                    <div class="custom-control custom-checkbox checkbox-info check-lg mr-3">
                                        <label class="custom-control-label" for="checkAll">
                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                            Alles Auswählen
                                        </label>
                                    </div>
                                    <div class="row">
                                        @foreach($permission as $value)
                                            <div class="col-auto">
                                                @switch(TRUE)
                                                    @case(stristr($value->name,'delete'))
                                                    <div class="custom-control custom-checkbox m-3 checkbox-danger">
                                                        @break
                                                        @case(stristr($value->name,'role'))
                                                        <div class="custom-control custom-checkbox m-3 checkbox-secondary">
                                                            @break
                                                            @case(stristr($value->name,'user'))
                                                            <div class="custom-control custom-checkbox m-3 checkbox-Warning">
                                                                @break
                                                                @case(stristr($value->name,'drink'))
                                                                <div class="custom-control custom-checkbox m-3 checkbox-info">
                                                                    @break
                                                                    @default
                                                                    <div class="custom-control custom-checkbox m-3 checkbox-success">
                                                                        @endswitch
                                                                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name checkbox custom-control-input', 'id' => $value->id)) }}
                                                                        <label class="custom-control-label"
                                                                               for="{{ $value->id }}">{{ $value->name }}</label>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                    <x-cards.card_footer_create :route="'roles'"/>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('checkAll').onclick = function () {
                                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                for (var checkbox of checkboxes) {
                                    checkbox.checked = this.checked;
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
