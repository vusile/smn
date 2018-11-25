@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Nyimbo zilizojirudia:</h3>
            <br />
           
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="needs-validation" method="post" action="/remove-song-duplicates" id="review-form" novalidate enctype='multipart/form-data'>
                @foreach($duplicates as $songId => $songDuplicates)
                    @include('cleanup.songs.question')
                    <input type="hidden" value="{{$songDuplicates->pluck('id')->implode(',')}}" name="song-{{$songId}}-duplicates" />
                @endforeach
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="song_ids" value="{{$songIds}}">

                <button type="submit" class="btn btn-primary">Ondoa Duplicates</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@stop