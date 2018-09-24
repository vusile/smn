@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $title }}</h1>
    <p class="lead">{{ $description }}.</p>
</div>

<div class="container">
    <div class="row">
        @foreach($blogPosts as $blogPost)
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $blogPost->title }}</h2>
                        <p class="card-text">{{ str_limit(strip_tags($blogPost->text), 200) }}</p>
                        <p><a class="btn btn-secondary" href="/blog/{{ $blogPost->url }}/{{ $blogPost->id }}" role="button">Soma Zaidi</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop