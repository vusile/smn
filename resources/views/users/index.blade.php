@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $title }}</h1>
    <p class="lead">{{ $description }}.</p>
</div>

<div class="container">
    @include('layouts.alphabets')
    @foreach($users as $user)
        <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
            <div id="{{ substr($user->name,0,1) }}" class="col-lg-4" >
                <p>{{ Str::title($user->name) }}

                </p>
            </div>
            <div class="col-lg-4" >
                <p><a href="/wapakia-nyimbo/{{Str::slug($user->name)}}/{{$user->id}}">Tazama nyimbo {{ $user->active_songs }} alizoupload</a></p>
            </div>
            <div class="col-lg-4" >

                @if($user->phone)
                    <p>Mpigie simu: {{ $user->phone }}</p>
                @endif

            </div>
        </div>
    @endforeach
</div>
@stop

