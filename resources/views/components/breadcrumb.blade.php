<div class="col-auto mt-0 form-head">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}">
                <i class="fas fa-home"></i>
                <!-- <span>Home</span> -->
            </a>
        </li>


        @foreach($breadcrumb as $b)
            @if(Route::has($b['1']))
                <li class="breadcrumb-item">
                    <a href="{{ route($b['1'], $b['2'] ?? '') }}">
                        {{ ucwords($b['0']) }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</div>
