@extends('layouts.backend-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Jobs</h1>
</div>

<div class="container">
    @foreach($jobs as $job)
        <a href ="/jobs/{{$job->id}}/delete">Delete</a>
        {{ ($job->payload) }} 
        <br><br>
    @endforeach
    {{ $jobs->links() }}
</div>
@stop
