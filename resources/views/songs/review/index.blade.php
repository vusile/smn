@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Tafadhali hakiki wimbo kwa kujibu maswali:</h3>
            <br />

            <div class="alert alert-success" role="alert">
                Unahakiki wimbo Unaitwa: <strong>{{$song->name}} umetunguwa na {{$song->composer->name}}</strong>. Tafadhali pakua nota zake, kisha ujibu maswali yanayofuata.
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
                <h4 class = 'alert-success'><strong>PDF: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'pdf')}}" target="_blank" role="button">Pakua Nota Uhakiki</a></h4>
                @foreach($pdfQuestions as $question)
                    @include('songs.review.question')
                @endforeach

                @if($song->can_be_edited)
                    <h4><strong><a href="/song/download/{{ $song->id }}/software/{{$song->software_file}}">Pakua File Ubadili</a></strong></h4>
                    <h4><strong><a href="/edit-song/{{ $song->id }}?return=review?return=review#pdf">Pakia PDF, midi na file jipya</a></strong></h4>
                @endif
                <br>
                @if($song->midi)
                    <h4 class = 'alert-success'><strong>Midi: </strong> <a class="btn btn-primary" href="/song/download/{{ $song->id }}/midi/{{ $song->midi }}" role="button">Download Midi Uhakiki</a></h4>
                    @foreach($midiQuestions as $question)
                        @include('songs.review.question')
                    @endforeach
                    <br>
                @endif
                <h4 class = 'alert-success'><strong>Jina la wimbo: </strong> {{ $song->name }} - <strong><a href="/edit-song/{{ $song->id }}?return=review#name">Badili/Boresha jina la wimbo</a></strong></h4>
                @foreach($nameQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <h4><strong><a href="/edit-song/{{ $song->id }}?return=review#name">Badili/Boresha jina la wimbo</a></strong></h4>


                <br>
                <h4 class = 'alert-success'><strong>Mtunzi: </strong> {{ $song->composer->name }} - <strong><a href="/edit-song/{{ $song->id }}#composer_id">Badili/Boresha jina la mtunzi</a></strong></h4>
                @foreach($composerQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <h4><strong><a href="/edit-song/{{ $song->id }}?return=review#composer_id">Badili/Boresha jina la mtunzi</a></strong></h4>
                <br>
                <h4 class = 'alert-success'><strong>Makundi Nyimbo: </strong> {{ $song->categories->pluck('title')->implode(' | ') }} - <strong><a href="/edit-song/{{ $song->id }}?return=review#categories">Badili/Boresha makundi nyimbo</a></strong></h4>
                @foreach($categoriesQuestions as $question)
                    @include('songs.review.question')
                @endforeach
                <h4><strong><a href="/edit-song/{{ $song->id }}?return=review#categories">Badili/Boresha makundi nyimbo</a></strong></h4>
                <br>

                @if($song->midi)
                    <h4 class = 'alert-success'><strong>Midi: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'midi')}}" role="button">Download Midi Uhakiki</a></h4>
                    @foreach($midiQuestions as $question)
                        @include('songs.review.question')
                    @endforeach
                    <br>
                @endif

                <h4 class = 'alert-success'><strong>Dominika / Sikukuu: </strong> - <strong><a href="/upload/dominika/{{ $song->id }}?return=review">Badili/Boresha dominika/sikukuu</a></strong></h4>

                <p>
                    @foreach($song->dominikas as $dominika)
                        - {{ $parts[$dominika->id]->name }} <a href = "/dominika-sikukuu/{{str_slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a><br>
                    @endforeach
                </p>
                @foreach($dominikaQuestions as $question)
                    @include('songs.review.question')
                @endforeach

                <h4><strong><a href="/upload/dominika/{{ $song->id }}?return=review">Badili/Boresha Dominika/Sikukuu</a></strong></h4>
                <br>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="song_id" value="{{$song->id}}">

                <button type="submit" class="btn btn-primary">Hifadhi Hakiki</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@stop
