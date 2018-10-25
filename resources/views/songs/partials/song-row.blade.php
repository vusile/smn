<div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
    <div id="{{ substr($song->name,0,1) }}" class="col-lg-4" >
        <p>{!! songLink($song) !!}<br>
            <small>
                Umetazamwa {{ $song->views }},
                Umepakuliwa {{ $song->downloads }}
            </small>
        </p>
    </div>
    <div class="col-lg-4" >
        <p>{{ $song->composer->name }}</p>
    </div>
    <div class="col-lg-4" >
        <p class="text-success">
            @if($song->midi)
                <span class="badge badge-success">Una Midi</span><br>
            @endif
            @if($song->lyrics)
                <span class="badge badge-primary">Una Maneno</span>
            @endif
        </p>
    </div>
</div>