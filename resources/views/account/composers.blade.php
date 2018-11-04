@extends('layouts.front-end')
@section('content')
@include('layouts.account-menu')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Watunzi niliowaupload - {{$composers->total()}}</h1>
</div>

<div class="container">
    @foreach($composers as $composer)
        @include("composers.partials.account-composer-row")
    @endforeach
    {{ $composers->links() }}
</div>
@stop
