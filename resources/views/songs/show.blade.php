@extends('layouts.front-end')
@section('header')
{{--    <script src="https://www.google.com/recaptcha/api.js?hl=sw" async defer></script>--}}

    <script src="https://www.google.com/recaptcha/api.js?hl=sw&render={{ env('RECAPTCHA_PUBLIC_KEY') }}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_PUBLIC_KEY') }}').then(function(token) {
                document.getElementById("recaptcha_token").value = token;
            }); });
    </script>
@endsection
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ $song->name }}</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p>
                    <strong>Mtunzi:</strong> {{ $song->composer->name }}

                    @if ($song->composer->has_profile) <br> > <a href="/composer/profile/{{ $song->composer->url }}/{{ $song->composer->id }}">Mfahamu Zaidi {{ $song->composer->name }} </a>@endif
                    @if ($otherSongs) <br> > <a href="/composer/songs/{{ $song->composer->url }}/{{ $song->composer->id }}">Tazama Nyimbo nyingine za {{ $song->composer->name }} </a>@endif
                </p>

                @if ($song->ithibati_number)
                    <p><strong>Namba ya Ithibati:</strong> {{ $song->ithibati_number }}</p>
                @endif
                <p><strong>Makundi Nyimbo:</strong> {{ $song->categories->pluck('title')->implode(' | ') }}</p>
                @if($song->user)
                    <p><strong>Umepakiwa na:</strong> {{ $song->user->name }}</p>
                @endif
                <p><strong>Umepakuliwa mara</strong> {{ number_format($song->downloads) }} | <strong>Umetazamwa mara</strong> {{ number_format($song->views) }}</p>

                @if($song->dominikas->count())
                <p>
                    <strong>Wimbo huu unaweza kutumika: </strong><br />
                    @foreach($song->dominikas as $dominika)
                        - {{ $parts[$dominika->id]->name }} <a href = "/dominika-sikukuu/{{Str::slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a><br>
                    @endforeach
                </p>
                @endif
<!--                <i class="fa fa-heart-o"></i>
                <p><a style="-moz-text-decoration-style: wavy; text-decoration: underline;" href="/favorites/addtofavorites/{{ $song->id }}">
                        Weka wimbo kwenye favorites</a></p>-->
<!--                @if($song->place_of_composition || $song->date_of_composition)
                    <p>Umetungwa
                        {{ $song->place_of_composition }}
                        {{
                            $song->date_of_composition ? ' ' . date("M d, Y",strtotime($song->date_of_composition)): ''
                        }}
                    </p>
                @endif-->

<a class="btn btn-primary" href="{{downloadLink($song, 'pdf')}}" role="button">Download Nota</a>
                @if($song->midi)
                    <a class="btn btn-primary" href="{{downloadLink($song, 'midi')}}" role="button">Download Midi</a>
                @endif
            </div>
            @if($song->lyrics)
            <div class="col-md-4" >
                <h6>Maneno ya wimbo</h6>
                <small>{!! str_replace('&nbsp;</p>', '</p>', $song->lyrics) !!}</small>
            </div>
            @endif
            @if($otherSongs)
            <div class="col-md-4" >
                <h6>Nyimbo nyingine za mtunzi huyu</h6>
                <ul class="list-unstyled mt-3 mb-4">
                    @foreach($otherSongs as $otherSong)
                    <li> - {!! songLink($otherSong) !!}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

    </div>
    <div class="container">
        <br>

        <div class="row">
            <div class="col-sm-12">
                <h3>Maoni - <small><a href="#comments-form">Toa Maoni</a></small></h3>
                @if(!$song->comments->count())
                    <p><strong>Hakuna maoni kwenye wimbo huu</strong></p>
                @endif
            </div><!-- /col-sm-12 -->
        </div><!-- /row -->

        @foreach($song->comments->reverse() as $comment)
            @if($comment->comment == strip_tags($comment->comment))
                <div class="row" id='{{ $comment->id }}'>
                    <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            {{ $comment->name . ' ' . date("M d, Y",strtotime($comment->comment_date))}}
                          </div>
                          <div class="card-body">
                            <blockquote class="blockquote mb-0">

                              <footer class="blockquote-footer">{{ $comment->comment }}</footer>
                            </blockquote>
                          </div>
                        </div>
                    </div>
                </div>
                <br>
            @endif
        @endforeach
        <div class="row">
            <div class="col-sm-6">
                <strong>Toa Maoni yako hapa</strong>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="/comment" id="comments-form">
                    <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                    <div class="form-group">
                      <label for="name">Jina lako</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Jina lako" required="">
                    </div>

                    <div class="form-group">
                      <label for="phone">Namba ya simu</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Namba ya simu">
                    </div>

                    <div class="form-group">
                      <label for="email">Email yako</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email yako">
                    </div>

                    <div class="form-group">
                      <label for="comment">Maoni yako</label>
                      <textarea required="" class="form-control" id="comment" name="comment" rows="3" placeholder="Pongeza, Kosoa.... Uwe mstaarabu"></textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" value='{{$song->id}}' name ='song_id' />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name ='maoni' class ='maoni' />
                          <button type="submit" class="btn btn-primary">Toa maoni</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
