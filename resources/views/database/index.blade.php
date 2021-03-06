@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))
<x-alert type="success" :message="$message" />
@endif

@if($message = Session::get('warning'))
<x-alert type="warning" :message="$message" />
@endif

<article class="row g-3">
    <section class="col-12">
        <div class="row d-flex align-content-center">
            <div class="col-lg-8">
                <h1>
                    {{ $title }}
                </h1>
            </div>
        </div>
        <x-breadcrumb :breadcrumb="[
                                                [__('Datenbank'), 'database'],
                                            ]" />
    </section>
@if(Route::has('database.backup'))
@can('database-backup')
    <section class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('Datenbank') }}
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-12">
                        <form action="{{ route('database.store') }}" method="post">
                            @method('post')
                            @csrf
                            <button type="submit" class="btn btn-outline-success w-100" name="table_backup"
                                id="table_backup">Backup</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>
    @endcan
    @endif
@if(Route::has('database.clear'))
@can('database-clear')
    <section class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('Datenbank Leeren') }}
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-12">
                        <div class="btn-group btn-group-vertical w-100" role="group"
                            aria-label="Basic checkbox toggle button group">
                            <input type="button" class="btn-check" id="table_events" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="Termine">
                            <label class="btn btn-outline-danger" for="table_events">
                                {{ __('Termine') }}
                            </label>

                            <input type="button" class="btn-check" id="table_groups" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="Gruppen">
                            <label class="btn btn-outline-danger" for="table_groups">
                                {{ __('Gruppen') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @endcan
    @endif
</article>
@if(Route::has('database.clear'))
@can('database-clear')
<div class="modal fade" id="modal_table" tabindex="-1" aria-labelledby="modal_tableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tableLabel">
                    {{ __('L??schen/Leeren') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('database.destroy') }}">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <div class="row g-3 mb-2">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-auto d-none">
                                    <input class="input_table" id="modal_table_input" value="" name="modal_table_input"
                                        readOnly>
                                </div>
                                <div class="col-auto mx-0">
                                    <label class="form-check-label" for="table_action">
                                        {{ __('L??schen') }}
                                    </label>
                                </div>
                                <div class="col-auto mx-0">
                                    <div class="form-check form-switch">
                                        <input class=" form-check-input" type="checkbox" value="1" name="table_action"
                                            id="table_action" checked>
                                    </div>
                                </div>
                                <div class="col-auto mx-0">

                                    <label class="form-check-label" for="table_action">
                                        {{ __('Leeren') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <p id="modal_input_action">{{ __('Leeren') }}:</p>

                                <i>
                                    <h5 class="input_table" id="modal_input"></h5>
                                </i>

                            </div>
                        </div>
                        <div class="col-12" id="table_info" hidden>
                            <div>
                                <i>
                                    {{ __('Beim Leeren oder L??schen von der Termin Tabelle wird automatisch auch die
                                    Gruppen Tabelle mit geleert/gel??scht!') }}
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Schlie??en') }}
                    </button>
                    <button type="submit" class="btn btn-warning" name="tabel_renew" id="submit_table">
                        {{ __('Leeren') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endif
<script>
    var modal_table = document.getElementById('modal_table')
    modal_table.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var table = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = modal_table.querySelector('.modal-title')
    var modalBody = modal_table.querySelector('.modal-body #modal_input')
    var modalBodyInput = modal_table.querySelector('.modal-body #modal_table_input')

    modalTitle.textContent = 'Datenbank Tabelle: ' + table
    modalBody.textContent = table
    modalBodyInput.value = table

    if(table == 'Termine'){
        document.getElementById('table_info').hidden = false
    }else{
        document.getElementById('table_info').hidden = true
    }
  })
</script>

<script>
    const action_switch = document.getElementById('table_action')
    const submit = document.getElementById('submit_table')
    const input = document.getElementById('modal_input')
    const input_action = document.getElementById('modal_input_action')

    action_switch.addEventListener('change', () => {
        if(action_switch.checked){
            input_action.innerHTML = 'Leeren:'
            submit.innerHTML = 'Leeren'
            submit.classList.remove('btn-danger')
            submit.classList.add('btn-warning')
        }else{
            input_action.innerHTML = 'L??schen:'
            submit.innerHTML = 'L??schen'
            submit.classList.remove('btn-warning')
            submit.classList.add('btn-danger')
        }
    })

</script>
@endsection
