@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">MAKUNDI NYIMBO - <a href="/admin/categories/create">Create New Category</a></h1>
        <!--<p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>-->
    </div>
<div class="container">
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        @foreach($categories as $category)
            <div class="col-lg-3" style="text-align: center">
                <a href="/admin/categories/{{ $category->id }}">
                    <img  src="{{ config('categories.files.paths.icons') . $category->image }}" alt="{{ $category->title }}" width="145" height="100">
                <p><strong>{{ $category->title }}</strong></p></a>
            </div>
            @if ( ($loop->index + 1) %4 == 0 )
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>
@stop

