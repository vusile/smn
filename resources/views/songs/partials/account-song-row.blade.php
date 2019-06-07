<div class="row  {{$loop->index%2 == 0 ? "nk-white" : "" }} ">
    <div id="{{ substr($song->name,0,1) }}" class="col-lg-4" >
        @if ($song->is_active)
        <p><span class="badge badge-pill badge-success">&nbsp;</span> {!! songLink($song, true) !!}<br>
        @else
            <p><span class="badge badge-pill badge-warning">&nbsp;</span> {{ $song->name }} 
                @if(auth()->user()->hasAnyRole(['super admin', 'admin']) && !$song->priority_review) - <a style="color:green" href="/prioritize-review/{{$song->id}}">Kipaumbele cha Uhakiki</a>@endif
                @if(auth()->user()->hasAnyRole(['super admin', 'admin']) && $song->priority_review) - <a style="color:red" href="/deprioritize-review/{{$song->id}}">Ondoa Kipaumbele cha Uhakiki</a>@endif
            <br>
        @endif
            <small>
                <a href = '/edit-song/{{$song->id}}'>Badili Wimbo</a> | 
                <a href = '/upload/preview/{{$song->id}}'>Hakiki Wimbo</a> |
                <!--<a href = '/delete-song/{{$song->id}}'>Ondoa Wimbo</a>-->
            </small>
        </p>
    </div>
    <div class="col-lg-4" >
        <p>
            {{ $song->composer->name }}
            @if ($song->ithibati_number)
                <br><small><strong>Namba ya Ithibati:</strong> {{ $song->ithibati_number }}</small>
            @endif
            <br><small><strong>Pakua:</strong> <a href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" role="button">Download Nota</a></small>
        </p>
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