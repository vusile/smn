@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Matokeo ya Utafutaji</h1>
    <p class="lead">Kuna watunzi {{ number_format($composersTotal) }} na nyimbo {{ number_format($songsTotal) }} zilizopatikana kutokana na utafutaji.</p>
</div>

<div class="container">
    <h2>Watunzi waliopatikana</h2>
    @include('layouts.alphabets')
    @foreach($composers->sortBy('name') as $composer)
        @include('composers.partials.composers-row')
    @endforeach
</div>
<div class="container">
    <h2>Nyimbo zilizopatikana</h2>
    @include('layouts.alphabets')
    @foreach($songs->sortBy('name') as $song)
        @include('songs.partials.song-row')
    @endforeach
</div>
@stop
