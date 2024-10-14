@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">TAARIFA MBALIMBALI - <a href="/admin/pages/create">Create New Blog Post</a></h1>
        <!--<p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>-->
    </div>
<div class="container">
    @foreach($blogPosts as $blogPost)
    <div class="row">
        <div class="col-lg-4" >
            <a href="/admin/pages/{{ $blogPost->id }}">
            <p><strong>{{ $blogPost->title }}</strong></p></a>
        </div>
        <div class="col-lg-4" style="text-align: center">
            <a href="/admin/pages/{{ $blogPost->id }}">
            <p><strong>Edit</strong></p></a>
        </div>
        <!-- @if ( ($loop->index + 1) %4 == 0 )
        </div><div class="row">
        @endif -->
        
    </div>
    @endforeach
</div>
@stop

