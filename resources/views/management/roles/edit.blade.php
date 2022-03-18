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
                                [__($role->name), 'roles.show', [$role->id, $role->name]],
                                ['Bearbeiten', 'roles.edit', [$role->id, $role->name]]
                            ]"/>

        {{-- @if (count($errors) > 0)
            <x-alert.error_input :errors="$errors" />
        @endif --}}

        <div class="row d-flex justify-content-center">
            <div class="col-md-11 col-lg-10">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <a class="btn btn-sm btn-rounded btn-outline-primary w-50"
                           href="{{ route('roles.show', [$role->id, $role->name]) }}">
                            {{ __('Nur Anzeigen') }}
                        </a>
                    </div>
                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
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
                                            <input type="checkbox" class="checkAll custom-control-input" id="checkAll">
                                            Alles Auswählen
                                        </label>
                                    </div>
                                    <div class="row">
                                        @php
                                            $admin_roles = array('user-list','user-create','user-edit', 'user-delete', 'user-ban', 'role-list', 'role-create', 'role-edit', 'role-delete');
                                        @endphp
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
                                                                        @if(in_array($value->name, $admin_roles))
                                                                            @role('administrator')
                                                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), array('class' => $value->name . ' custom-control-input', 'id' => $value->id)) }}
                                                                            <label class="custom-control-label"
                                                                                   for="{{ $value->id }}">{{ $value->name }}</label>
                                                                            @endrole
                                                                        @endif
                                                                        @if(!in_array($value->name, $admin_roles))
                                                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), array('class' => $value->name . ' custom-control-input', 'id' => $value->id)) }}
                                                                            <label class="custom-control-label"
                                                                                   for="{{ $value->id }}">{{ $value->name }}</label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                    @php
                                        $del = '1';

                                        if($role->name == 'administrator'){
                                            $del = '0';
                                        }
                                    @endphp
                                    <x-cards.card_footer_edit :route="'roles'" :del="$del"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <x-modal.delete :route="'roles.destroy'" :id="$id"/>
                    <script>
                        document.querySelector('#checkAll').onclick = function () {
                            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                            for (var checkbox of checkboxes) {
                                checkbox.checked = this.checked;
                            }
                        }
                    </script>
@endsection
