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
            
        @endif
    @endforeach
</div>
@stop

