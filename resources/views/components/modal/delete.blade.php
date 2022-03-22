<div class="modal fade" id="Modal">
    <div class="modal-dialog" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? 'Löschen'}}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
                {{$txt ?? 'Wollen sie den Eintrag wirklich Löschen?'}}
            </div>
            <form action="{{ route($route, $id) }}" method="post">
                @method('delete')
                @csrf
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-rounded btn-outline-danger w-100">
                    Löschen
                </button>
                <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary w-100" data-dismiss="modal">
                    Schließen
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
