@extends('layouts.backend-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Watunzi niliowaupload - {{$composers->count()}}</h1>
</div>

<div class="container">
    @foreach($me as $composer)
        @if(isset($composer->name))
            @include("composers.partials.account-composer-row")
        @endif
    @endforeach
    @foreach($composers as $composer)
        @if(isset($composer->name))
            @include("composers.partials.account-composer-row")
        @endif
    @endforeach
    {{ $composers->links() }}
</div>
@stop
