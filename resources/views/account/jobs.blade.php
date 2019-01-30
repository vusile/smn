@extends('layouts.backend-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Jobs</h1>
</div>

<div class="container">
    @foreach($jobs as $job)
        @if(str_contains($job->payload, ['CommentPosted', 'ComposerSongApprovedEmail']) )
            <a href ="/jobs/{{$job->id}}/delete">Delete</a>
            {{ ($job->payload) }} 
        
            <br><br>
        @endif
    @endforeach
    {{ $jobs->links() }}
</div>
@stop
