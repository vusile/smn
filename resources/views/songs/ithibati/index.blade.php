@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            @if($song)
            <h3>Je wimbo huu unafaa kupewa ithibati:</h3>
            <br />
           
            <div class="alert alert-success" role="alert">
                Wimbo: <strong>{{$song->name}}</strong> umetungwa na <strong>{{$song->composer->name}}</strong>. <a class="btn btn-primary" href="/song/download/{{ $song->id }}/pdf/{{$song->pdf}}" target="_blank" role="button">Pakua Nota Uhakiki</a>
                
                @if($song->for_recording)
                    <br><br>
                    <strong>MUHIMU:</strong> Wimbo huu utatumika kwenye kurekodi Album
                @endif
                
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
            
            <form class="needs-validation" method="post" action="/akaunti/toa-ithibati/store" id="review-form" novalidate enctype='multipart/form-data'>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="fit_for_liturgy" type="checkbox" id="fit_for_liturgy" value="1" @if($song->fit_for_liturgy) checked="checked" @endif>
                              <label class="form-check-label" for="fit_for_liturgy">Wimbo huu unafaa kuimbwa kwenye ibada ya misa</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <h4><strong>Wimbo huu:</strong></h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="give_ithibati" type="radio" id="give_ithibati_yes" value="1">
                              <label class="form-check-label" for="give_ithibati_yes">Unafaa Kupata Ithibati</label>
                              <input class="form-check-input" name="give_ithibati" type="radio" id="give_ithibati_no" value="0">
                              <label class="form-check-label" for="give_ithibati_no">Haufai Kupata Ithibati</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="comment_div" class = 'form-group row'>
                    <label class="col-sm-12 col-form-label">Kama wimbo haujapata ithibati, tafadhali elezea hapa kwa nini ithibati imekosekana:</label><br>
                    <textarea class="form-control" name="comment" id='comment'  rows="2"></textarea>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="song_id" value="{{$song->id}}">

                <button type="submit" class="btn btn-primary">Hifadhi</button>
            </form>
            @else
            <h3>Hakuna wimbo unaosuribiri Ithibati</h3>
            @endif
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@stop