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
                <div class="ml-auto pull-right">
                    <a class="btn btn-md btn-rounded btn-primary" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        </div>
        <x-breadcrumb :breadcrumb="[
                                ['Benutzer', 'users.index'],
                                ['Benutzer Hinzufügen', 'users.create'],
                            ]"/>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-md-11 col-lg-10">
                <div class="card">
                    <div class="card-body">


                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Name:</h4> -->
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    <label for="name">
                                        Name
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Email:</h4> -->
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    <label for="email">
                                        E-Mail Adresse
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Password:</h4> -->
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    <label for="password">
                                        Passwort
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-floating">
                                    <!-- <h4>Confirm Password:</h4> -->
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    <label for="confirm-password">
                                        Passwort Bestätigen
                                        <strong style="color:red;">*</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10">
                                <div class="form-group">
                                    <h4>Role:</h4>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control multi-value-select','multiple')) !!}
                                </div>
                            </div>
                            <div class="col-md-11 col-lg-10 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection
