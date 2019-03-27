<div class="row  {{$loop->index%2 == 0 ? "nk-white" : "" }} ">
    <div class="col-lg-4" >
        <p>{{$user->name}}<br>
            <small>Nyimbo: {{$user->songs()->count()}}</small>
        </p>
    </div>
    
    <div class="col-lg-4" >
        @if($user->hasAnyRole(['uhakiki', 'ithibati', 'admin', 'super admin']))
            <p>
                @if($user->hasRole('uhakiki'))
                    <a href = '/remove-role/uhakiki/{{$user->id}}'>Ondoa uwezo wa Kuhakiki</a><br>
                @endif
                @if($user->hasRole('ithibati'))
                    <a href = '/remove-role/ithibati/{{$user->id}}'>Ondoa uwezo wa Kutoa Ithibati</a><br>
                @endif
                @if($user->hasRole('admin'))
                    <a href = '/remove-role/admin/{{$user->id}}'>Ondoa uwezo wa Kuwa Admin</a><br>
                @endif
            </p>
        @else
            <p>
                <a href = '/assign-role/uhakiki/{{$user->id}}'>Mpe uwezo wa Kuhakiki</a><br>
                <a href = '/assign-role/ithibati/{{$user->id}}'>Mpe uwezo wa Kutoa Ithibati</a><br>
                <a href = '/assign-role/admin/{{$user->id}}'>Mpe uwezo wa Kuwa Admin</a><br>
            </p>
        @endif
    </div>
    <div class="col-lg-4" >
        <p class="text-success">
            @if(auth()->user()->hasAnyRole(['super admin']))
                <a href = 'impersonate/{{$user->id}}'>Impersonate</a>
            @endif
        </p>
    </div>
</div>