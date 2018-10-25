@extends('layouts.front-end')
@section('content')
@include('layouts.account-menu')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Hakiki Wimbo Tafadhali</h3>
            
            <p><strong>Jina la wimbo: </strong> {{ $song->name }}</p>
            <p><strong>Mtunzi: </strong> {{ $song->composer->name }}</p>
            <p><strong>Makundi Nyimbo: </strong> {{ $song->categories->pluck('title')->implode(' | ') }}</p>
            <p><strong>PDF: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/pdf" role="button">Download Nota Uhakiki</a></p>
            
            @if($song->midi)
                <p><strong>Midi: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/midi" role="button">Download Midi Uhakiki</a></p>
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
    
@section('footer')
    <script type="text/javascript" src="/js/fastselect.standalone.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mwanzo').fastselect();
            $('#katikati').fastselect();
            $('#shangilio').fastselect();
            $('#antifona').fastselect();
        });
    </script>
    
@stop
@stop