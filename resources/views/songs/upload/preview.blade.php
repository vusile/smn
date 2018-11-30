@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Hakiki Wimbo Tafadhali</h3>
            <br />
            <p><strong>Jina la wimbo: </strong> {{ $song->name }}</p>
            <p><strong>Mtunzi: </strong> {{ $song->composer->name }}</p>
            <p><strong>Makundi Nyimbo: </strong> {{ $song->categories->pluck('title')->implode(' | ') }}</p>
            <p><strong>PDF: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" role="button">Download Nota Uhakiki</a></p>
            
            @if($song->midi)
                <p><strong>Midi: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/midi/{{ $song->midi }}" role="button">Download Midi Uhakiki</a></p>
            @endif
  
            @if($song->dominikas->count())
                <p>
                    <strong>Wimbo huu unaweza kutumika: </strong><br />
                    @foreach($song->dominikas as $dominika)
                        - {{ $parts[$dominika->id]->name }} <a href = "/dominika-sikukuu/{{str_slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a><br>
                    @endforeach
                </p>
            @endif
            
            @if($song->lyrics)
                <p><strong>Maneno ya wimbo: </strong></p> <small>{!! str_replace('&nbsp;</p>', '</p>', $song->lyrics) !!}</small>
            @endif
            
            <a class="btn btn-primary" href="/akaunti/nyimbo/pending" >Wimbo Upo Sahihi</a>
            <a class="btn btn-primary" href="/edit-song/{{$song->id}}" >Fanya Marekebisho</a>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
   
@stop