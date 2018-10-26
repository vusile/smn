@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $title }}</h1>
    <p class="lead">{{ $description }}.</p>
</div>

<div class="container">
    @include('layouts.alphabets')
    
    @foreach($users as $user)
        @if($user->songs->count() && $user->name)
            <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
                <div id="{{ substr($user->name,0,1) }}" class="col-lg-4" >
                    <p>{{ title_case($user->name) }}
                   
                    </p>
                </div>
                <div class="col-lg-4" >
                    <p><a href="/wapakia-nyimbo/{{str_slug($user->name)}}/{{$user->id}}">Tazama nyimbo {{ $user->activeSongs()->count() }} alizoupload</a></p>
                </div>
                <div class="col-lg-4" >
                    
                    @if($user->phone)
                        <p>Mpigie simu: {{ $user->phone }}</p>
                    @endif

                </div>
            </div>
        @endif
    @endforeach
</div>
@stop

