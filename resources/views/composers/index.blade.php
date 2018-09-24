@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $title }}</h1>
    <p class="lead">{{ $description }}.</p>
</div>

<div class="container">
    @include('layouts.alphabets')
    @foreach($composers as $composer)
        @if($composer->name)
            <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
                <div id="{{ substr($composer->name,0,1) }}" class="col-lg-4" >
                    <p>{{ $composer->name }}</p>
                </div>
                <div class="col-lg-4" >
                    <p><a href="/composer/songs/{{$composer->url}}/{{$composer->id}}">Tazama nyimbo zake {{ $composer->songs->count() }}</a></p>
                </div>
                <div class="col-lg-4" >
                    
                    @if($composer->has_profile)
                        <p><a href="/composer/profile/{{$composer->url}}/{{$composer->id}}">Soma zaidi kuhusu {{ $composer->name }}</a></p>
                    @endif
                    
                </div>
            </div>
        @endif
    @endforeach
</div>
@stop

