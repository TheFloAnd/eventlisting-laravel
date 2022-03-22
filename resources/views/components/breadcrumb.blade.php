<div class="row">
    <div class="col-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}">
                <i class=""> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                </svg></i>
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
</div>
