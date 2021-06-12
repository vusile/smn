@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Majibu ya Uhakiki</h3>
            <br />
            <p><strong>Jina la wimbo: </strong> {{ $song->name }}</p>
            <p><strong>Mtunzi: </strong> {{ $song->composer->name }}</p>

            @foreach($songReviews as $songReview)
                {{$loop->iteration}}. <strong>{!! $songReview->question !!}</strong> - {{$songReview->value}} <br>
            @endforeach
            
            <a class="btn btn-primary" href="/akaunti/review-nyimbo" >Hakiki Wimbo Mwingine</a>
           
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
   
@stop