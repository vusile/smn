<div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
    <div id="{{ substr($song->name,0,1) }}" class="col-lg-4" >
        <p>
            @if($song->status != 7)
                {!! songLink($song) !!}
            @else
                <strong>{{ $song->name }}</strong>
            @endif
            <br>
            @if($song->status != 7)
                <small>
                    Umetazamwa {{ number_format($song->views) }},
                    Umepakuliwa {{ number_format($song->downloads) }}
                </small>
            @else
                <small>
                    Wimbo huu bado unarekodiwa. Hauwezi kupakuliwa
                </small>
            @endif
        </p>
    </div>
    <div class="col-lg-4" >
        <p>{{ $song->composer->name }}</p>
    </div>
    <div class="col-lg-4" >
        @if ($song->ithibati_number)
            <small><strong>Namba ya Ithibati:</strong> {{ $song->ithibati_number }}</small><br>
        @endif
        <p class="text-success">
            @if($song->status != 7)
                @if($song->midi)
                    <span class="badge badge-success">Una Midi</span><br>
                @endif
                @if($song->lyrics)
                    <span class="badge badge-primary">Una Maneno</span>
                @endif
            @endif
        </p>
    </div>
</div>
