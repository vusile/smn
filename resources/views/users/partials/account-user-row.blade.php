<div class="row  {{$loop->index%2 == 0 ? "nk-white" : "" }} ">
    <div class="col-lg-4" >
        <p>{{$user->name}}<br>
            <small>Nyimbo: {{$user->songs()->count()}}</small>
        </p>
    </div>
    
    <div class="col-lg-4" >
        <p>
            @if($user->hasRole('uhakiki'))
                <a style ="color: red" href = '/remove-role/uhakiki/{{$user->id}}'>Ondoa uwezo wa Kuhakiki</a>
            @elseif(!$user->hasRole('uhakiki'))
                <a href = '/assign-role/uhakiki/{{$user->id}}'>Mpe uwezo wa Kuhakiki</a>
            @endif
            <br>

            @if($user->hasRole('ithibati'))
                <a style ="color: red" href = '/remove-role/ithibati/{{$user->id}}'>Ondoa uwezo wa Kutoa Ithibati</a>
            @elseif(!$user->hasRole('ithibati'))
                <a href = '/assign-role/ithibati/{{$user->id}}'>Mpe uwezo wa Kutoa Ithibati</a>
            @endif
            <br>

            @if($user->hasRole('admin'))
                <a style ="color: red" href = '/remove-role/admin/{{$user->id}}'>Ondoa uwezo wa Kuwa Admin</a>
            @elseif(!$user->hasRole('admin'))
                <a href = '/assign-role/admin/{{$user->id}}'>Mpe uwezo wa Kuwa Admin</a>
            @endif
            <br>

            @if($user->hasRole('viongozi kamati muziki'))
                <a style ="color: red" href = '/remove-role/viongozi kamati muziki/{{$user->id}}'>Ondoa uwezo wa Kiongozi wa Uhakiki</a>
            @elseif(!$user->hasRole('viongozi kamati muziki'))
                <a href = '/assign-role/viongozi kamati muziki/{{$user->id}}'>Mpe uwezo wa Kiongozi Kamati ya Muziki</a>
            @endif
            <br>

            @if($user->hasRole('viongozi uhakiki'))
                <a style ="color: red" href = '/remove-role/viongozi uhakiki/{{$user->id}}'>Ondoa uwezo wa Kiongozi wa Uhakiki</a>
            @elseif(!$user->hasRole('viongozi uhakiki'))
                <a href = '/assign-role/viongozi uhakiki/{{$user->id}}'>Mpe uwezo wa Kiongozi wa Uhakiki</a>
            @endif
            
        </p>
    </div>
    <div class="col-lg-4" >
        <p class="text-success">
            @if(auth()->user()->hasAnyRole(['super admin']))
                <a href = '/impersonate/{{$user->id}}'>Impersonate</a>
            @endif
        </p>
    </div>
</div>