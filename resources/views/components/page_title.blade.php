<div class="row">
    <div class="form-head d-flex align-items-start">
        <div class="row page-titles mb-0 mx-0">
            <div class="col">
                <h2 class="text-black font-w600">
                    {{ $title }}
                </h2>
            </div>
        </div>
        @if($add ?? '0' == '1')
            <div class="pull-right ml-auto px-3">
                @if(Route::has($route))
                    <a type="button" class="btn btn-md btn-rounded btn-outline-success light flex-nowrap"
                       href="{{ route($route) }}">
                        {{-- <span class="btn-icon-left text-secondary">
                            <i class="fas fa-{{ $icon }}"></i>
                        </span> --}}
                        {{ $btn_txt ?? 'Hinzufügen' }}
                        <span class="btn-icon-right">
                    <i class="fas fa-plus"></i>
                </span>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
