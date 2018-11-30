@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Tafadhali hakiki wimbo kwa kujibu maswali:</h3>
            <br />
            
            @if (session('songs_reviewed', 0) >= config('song.reviews.no_of_reviews_per_song'))
                <div class="alert alert-success" role="alert">
                    Asante kwa ku-review nyimbo {{session('songs_reviewed')}}. Sasa unaweza ku-upload wimbo. Unaweza pia kuendelea kureview ukitaka<br>
                    <a class="btn btn-primary" href="{{route('song-upload.index')}}" >Pakia Wimbo</a>
                </div>
            @endif
            <div class="alert alert-success" role="alert">
                Unareview wimbo wa {{ session('songs_reviewed', 0)+1 }}. Unaitwa: <strong>{{$song->name}} wa {{$song->composer->name}}</strong>. Tafadhali pakua nota zake, kisha ujibu maswali yanayofuata.
            </div>

            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="needs-validation" method="post" action="/akaunti/review-nyimbo/store" id="review-form" novalidate enctype='multipart/form-data'>
                <h4 class = 'alert-success'><strong>PDF: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" target="_blank" role="button">Pakua Nota Uhakiki</a></h4>
                @foreach($pdfQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                <h4 class = 'alert-success'><strong>Jina la wimbo: </strong> {{ $song->name }}</h4>
                @foreach($nameQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                <h4 class = 'alert-success'><strong>Mtunzi: </strong> {{ $song->composer->name }}</h4>
                @foreach($composerQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>
                <h4 class = 'alert-success'><strong>Makundi Nyimbo: </strong> {{ $song->categories->pluck('title')->implode(' | ') }}</h4>
                @foreach($categoriesQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <br>

                @if($song->midi)
                    <h4 class = 'alert-success'><strong>Midi: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/midi" role="button">Download Midi Uhakiki</a></h4>
                    @foreach($midiQuestions as $question)
                        @include('songs.review.question')
                    @endforeach
                    <br>
                @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="song_id" value="{{$song->id}}">

                <button type="submit" class="btn btn-primary">Hifadhi Hakiki</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@stop