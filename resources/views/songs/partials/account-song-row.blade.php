<div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
    <div id="{{ substr($song->name,0,1) }}" class="col-lg-4" >
        @if ($song->is_active)
        <p><span class="badge badge-pill badge-success">&nbsp;</span> {!! songLink($song) !!}<br>
        @else
            <p><span class="badge badge-pill badge-warning">&nbsp;</span> {{ $song->name }}<br>
        @endif
            <small>
                <a href = '/edit-song/{{$song->id}}'>Badili Wimbo</a> | 
                <a href = '/upload/preview/{{$song->id}}'>Hakiki Wimbo</a> |
                <!--<a href = '/delete-song/{{$song->id}}'>Ondoa Wimbo</a>-->
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