<div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
    <div id="{{ substr($composer->name,0,1) }}" class="col-lg-4" >
        <p>{{ title_case($composer->name) }}<br>
            <small>
                <a href = '/mtunzi/edit/{{$composer->id}}'>Boresha Taarifa za Mtunzi</a>
            </small>
        </p>
    </div>
    <div class="col-lg-4" >
        <p>
            <a href="/composer/songs/{{$composer->url}}/{{$composer->id}}">Tazama nyimbo zake {{ $composer->active_songs }}</a>
        </p>
    </div>
    <div class="col-lg-4" >

        @if($composer->has_profile)
            <p><a href="/composer/profile/{{$composer->url}}/{{$composer->id}}">Soma zaidi kuhusu {{ $composer->name }}</a></p>
        @endif

    </div>
</div>