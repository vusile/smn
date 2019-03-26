@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Tafadhali hakiki wimbo. Tumia maswali ya mwongozo kuhakiki:</h3>
            <br />
           
            <div class="alert alert-success" role="alert">
                Unahakiki wimbo Unaitwa: <strong>{{$song->name}}</strong> umetungwa na <strong>{{$song->composer->name}}</strong>. Tafadhali pakua nota zake, kisha ujibu maswali yanayofuata.
                <a class="btn btn-primary" href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" target="_blank" role="button">Pakua Nota Uhakiki</a>
                @if($song->for_recording)
                    <br><br>
                    <strong>MUHIMU:</strong> Wimbo huu utatumika kwenye kurekodi Album
                @endif
                @if($song->can_be_edited)
                    <br><br>
                    <strong>MUHIMU:</strong> Aliyepakia, <strong>KATOA</strong> ruhusa wimbo urekebishwe ikihitajika
                @else
                    <br><br>
                    <strong>MUHIMU:</strong> Aliyepakia, <strong>HAJATOA</strong> ruhusa wimbo urekebishwe
                @endif
            </div>
 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="needs-validation" method="post" action="/akaunti/review-nyimbo/ithibati-review" id="review-form" novalidate enctype='multipart/form-data'>
                <h4 class = 'alert-success'><strong>PDF: </strong></h4>
                
                <strong>Maswali ya kuzingatia</strong><br>
                @foreach($pdfQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                
                @if($song->can_be_edited)
                    <h4><strong><a href="/song/download/{{ $song->id }}/software/{{$song->software_file}}">Pakua File Ubadili</a></strong></h4>
                    <h4><strong><a href="/edit-song/{{ $song->id }}?return=review#pdf">Pakia PDF, midi na file jipya</a></strong></h4>
                @endif
                <br>
                <h4 class = 'alert-success'><strong>Jina la wimbo: </strong> {{ $song->name }} - <strong><a href="/edit-song/{{ $song->id }}?return=review#name">Badili/Boresha jina la wimbo</a></strong></h4>
                <strong>Maswali ya kuzingatia</strong><br>
                @foreach($nameQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                         
                <br>
                <h4 class = 'alert-success'><strong>Mtunzi: </strong> {{ $song->composer->name }} - <strong><a href="/edit-song/{{ $song->id }}#composer_id">Badili/Boresha jina la mtunzi</a></strong></h4>
                <strong>Maswali ya kuzingatia</strong><br>
                @foreach($composerQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                @if($song->fit_for_liturgy)
                    <h4 class = 'alert-success'><strong>Wimbo Unafaa kuimbwa kwenye ibada: Ndio</strong> - <strong><a href="/edit-song/{{ $song->id }}#fit_for_liturgy">Badili/Boresha</a></strong></h4>
                    @foreach($fitForLiturgyQuestions as $question)
                        @include('songs.review.question')
                    @endforeach
                    <br>
                @endif
                <h4 class = 'alert-success'><strong>Makundi Nyimbo: </strong> {{ $song->categories->pluck('title')->implode(' | ') }} - <strong><a href="/edit-song/{{ $song->id }}?return=review#categories">Badili/Boresha makundi nyimbo</a></strong></h4>
                <strong>Maswali ya kuzingatia</strong><br>
                @foreach($categoriesQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                
                <h4 class = 'alert-success'><strong>Dominika / Sikukuu: </strong> - <strong><a href="/upload/dominika/{{ $song->id }}?return=review">Badili/Boresha dominika/sikukuu</a></strong></h4>
                
                <p>
                    @foreach($song->dominikas as $dominika)
                        - {{ $parts[$dominika->id]->name }} <a href = "/dominika-sikukuu/{{str_slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a><br>
                    @endforeach
                </p>                
                <strong>Maswali ya kuzingatia</strong><br>
                @foreach($dominikaQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                
                <strong>Wimbo unafaa kupewa Ithibati?</strong><br>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="can_get_ithibati" type="radio" id="yes_can_get_ithibati" value="1">
                              <label class="form-check-label" for="yes_can_get_ithibati">Unafaa kupewa ithibati</label>
                              <br><input class="form-check-input" name="can_get_ithibati" type="radio" id="no_cant_get_ithibati" value="0">
                              <label class="form-check-label" for="no_cant_get_ithibati">Haufai kupewa ithibati</label>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="song_id" value="{{$song->id}}">

                <button type="submit" class="btn btn-primary">Hifadhi Hakiki</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@stop