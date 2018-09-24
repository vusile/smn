@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $dominika->title }}</h1>
    <p class="lead">Nyimbo za {{ $dominika->title }}.</p>
</div>

<div class="container">    
    <strong>Nyimbo za Mwanzo:</strong><br /><br />
    @foreach($approvedDominikaSongs->whereIn('id', $mwanzo) as $song)
        @include('songs.partials.song-row')
    @endforeach
    
    <br /><strong>Nyimbo za Katikati:</strong><br /><br />
    @foreach($approvedDominikaSongs->whereIn('id', $katikati) as $song)
        @include('songs.partials.song-row')
    @endforeach
  
    @if($shangilio)
        <br/><strong>Shangilio:</strong><br /><br />
        @foreach($approvedDominikaSongs->whereIn('id', $shangilio) as $song)
            @include('songs.partials.song-row')
        @endforeach
    @endif
    
    @if($antifona)
        <br /><strong>Antifona / Komunio:</strong><br /><br />
        @foreach($approvedDominikaSongs->whereIn('id', $antifona) as $song)
            @include('songs.partials.song-row')
        @endforeach
    @endif
</div>
@stop

