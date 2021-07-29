<div class="row  {{$loop->index%2 == 0 ? "nk-white" : "" }} ">
    <div id="{{ substr($song->name,0,1) }}" class="col-lg-4" >
        @if ($song->is_active)
        <p><span class="badge badge-pill badge-success">&nbsp;</span> {!! songLink($song, true) !!}<br>
        @else
            <p><span class="badge badge-pill badge-warning">&nbsp;</span> {{ $song->name }}<br>
        @endif
            <small>
                <a href = '/edit-song/{{$song->id}}'>Badili Wimbo</a> |
                <a href = '/upload/preview/{{$song->id}}'>Hakiki Wimbo</a> |
                <a href = '/delete-reason/{{$song->id}}'>Ondoa Wimbo</a>
            </small>
                <br><small><strong>Pakua:</strong> <a href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" role="button">Download Nota</a></small>
        </p>
    </div>
    <div class="col-lg-4" >
        <p>
            {{ $song->composer->name }}
            @if ($song->ithibati_number)
                <br><small><strong>Namba ya Ithibati:</strong> {{ $song->ithibati_number }}</small>
            @endif
            @if($song->midi)
                <span class="badge badge-success">Una Midi</span><br>
            @endif
            @if($song->lyrics)
                <span class="badge badge-primary">Una Maneno</span>
            @endif
        </p>
    </div>
    <div class="col-lg-4" >
        <p class="text-success">

            @if(auth()->user()->hasAnyRole(['super admin', 'admin', 'viongozi uhakiki']) && !$song->priority_review) - <a style="color:green" href="/prioritize-review/{{$song->id}}">Kipaumbele cha Uhakiki</a>@endif
            @if(auth()->user()->hasAnyRole(['super admin', 'admin', 'viongozi uhakiki']) && $song->priority_review) - <a style="color:red" href="/deprioritize-review/{{$song->id}}">Ondoa Kipaumbele cha Uhakiki</a>@endif
            <br>
            @if(auth()->user()->hasAnyRole(['super admin', 'admin', 'viongozi uhakiki'])) - <a style="color:green" href="/change-mhakiki/{{$song->id}}">Badili Mhakiki</a>@endif
            <br>
            @if(auth()->user()->hasAnyRole(['super admin', 'admin', 'viongozi kamati muziki'])) - <a style="color:green" href="/change-mtoa-ithibati/{{$song->id}}">Badili Mtoa Ithibati</a>@endif
        </p>
    </div>
</div>
