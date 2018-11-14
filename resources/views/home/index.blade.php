@extends('layouts.front-end')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">NYIMBO {{ number_format($activeSongsCount) }}</h1>
        <p class="lead"><strong>Dominika na Ibada Wiki hii</strong></p>
        @include('dominika.partials.wiki-hii')
    </div>
    <div class="container">
        <div class="card-deck mb-3 text-center">
            <div class="card mb-3 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Uploaded Hivi Karibuni</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    @foreach($recentSongs as $song)
                    <li style="margin-bottom: 10px;">{!! songLink($song) !!}<br>{{ $song->composer->name }}</li>
                    @endforeach
                </ul>
              </div>
            </div>
            <div class="card mb-3 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Kumi Bora za Wiki Hii</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    @foreach($weeklyTopTenSongs as $song)
                    <li style="margin-bottom: 10px;">{!! songLink($song) !!}<br>{{ $song->composer->name }}</li>
                    @endforeach
                </ul>
              </div>
            </div>
            <div class="card mb-3 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Kumi Bora Wakati Wote</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    @foreach($topTenSongs as $song)
                    <li style="margin-bottom: 10px;">{!! songLink($song) !!}<br>{{ $song->composer->name }}</li>
                    @endforeach
                </ul>
              </div>
            </div>
            <div class="card mb-3 shadow-sm">
              <div class="card-header">
                <h4 class="my-0 font-weight-normal">Wapakiaji wenye nyimbo nyingi</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    @foreach($topTenUploaders as $user)
                    <li style="margin-bottom: 10px;">{{ $user->first_name . ' ' . $user->last_name }}
                        <br>Nyimbo {{ number_format($user->songs()->approved()->count()) }}
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
        </div>
    </div>
@stop
