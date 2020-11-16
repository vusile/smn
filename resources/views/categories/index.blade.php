@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">MAKUNDI NYIMBO</h1>
        <!--<p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>-->
    </div>
<div class="container">
    <div class="row">
        @foreach($categories as $category)
            <div class="col-lg-3" style="text-align: center">
                <a href="/makundi-nyimbo/{{ $category->url }}/{{ $category->id }}"><img  src="{{ config('categories.files.paths.icons') . $category->image }}" alt="{{ $category->title }}" width="145" height="100">
                <p><strong>{{ $category->title }}</strong></p></a>
                <p><a class="btn btn-secondary" href="/makundi-nyimbo/{{ $category->url }}/{{ $category->id }}" role="button">Tazama nyimbo</a></p>
            </div>
            @if ( ($loop->index + 1) %4 == 0 )
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>
@stop

