@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $blogPost->title }}</h1>
    
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            {!! $blogPost->text !!}
        </div>
    </div>
</div>
@stop