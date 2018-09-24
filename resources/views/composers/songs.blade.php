@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $composer->name }}</h1>
    <p class="lead">Mkusanyiko wa nyimbo {{ number_format($approvedSongs->count()) }} za {{ $composer->name }}.</p>
</div>

<div class="container">
    @include('layouts.alphabets')
    
    @foreach($approvedSongs->sortBy('name') as $song)
        @include('songs.partials.song-row')
    @endforeach
</div>
@stop

