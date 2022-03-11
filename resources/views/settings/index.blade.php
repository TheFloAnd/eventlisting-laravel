@extends('layouts.app')

@section('content')
<article class="row g-3">
    <section class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-to-refresh">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('Datenbank') }}
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-12">
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-outline-success w-100" name="table_backup"
                                id="table_backup">Backup</button>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="btn-group btn-group-vertical w-100" role="group"
                            aria-label="Basic checkbox toggle button group">
                            <input type="button" class="btn-check" id="table_events" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="events">
                            <label class="btn btn-outline-danger" for="table_events">
                                events
                            </label>

                            <input type="button" class="btn-check" id="table_groups" data-bs-toggle="modal"
                                data-bs-target="#modal_table" data-bs-whatever="groups">
                            <label class="btn btn-outline-danger" for="table_groups">
                                groups
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}
</article>
<div class="modal fade" id="modal_table" tabindex="-1" aria-labelledby="modal_tableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_tableLabel">
                        delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-2">
                        <div class="col-12">
                            <div class="row mb-2">
                                <div class="col-auto mx-0">
                                    <label class="form-check-label" for="table_empty">
                                        delete
                                    </label>
                                </div>
                                <div class="col-auto mx-0">
                                    <div class="form-check form-switch">
                                        <input class=" form-check-input" type="checkbox" value="1" name="table_empty"
                                            id="table_empty" checked>
                                    </div>
                                </div>
                                <div class="col-auto mx-0">

                                    <label class="form-check-label" for="table_empty">
                                        to_empty
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">

                            <fieldset>
                                <div class="form-group">
                                    <input class="input_table" id="modal_table_input" value="" name="modal_table_input"
                                        readOnly>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <p>
                                delete_table
                            </p>
                            <span>
                                delete_table-info
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mb-2">

                        <fieldset>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="protection_pass" id="protection_pass"
                                    placeholder="Password">
                                <label for="protection_pass">Password</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            close
                        </button>
                        <button type="submit" class="btn btn-danger" name="tabel_renew">
                            submit
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
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
    var modalBodyInput = modal_table.querySelector('.modal-body .input_table')

    modalTitle.textContent = 'database-table: ' + table
    modalBodyInput.value = table
  })
</script>
@endsection
