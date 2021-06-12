@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-lg-8" >
            <br />
            <br />
            <h2>Badili Mfanya Uhakiki:</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="/save-mhakiki" id="mhakiki-form">
                <div class="form-group">
                  <p>Jina la wimbo: {{$song->name}}</p>

                    @if($mhakiki)
                        <p>Mfanya Uhakiki wa Sasa: {{$mhakiki->name}}</p>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-sm-8">
                        <p><strong>Chagua mfanya uhakiki mpya:</a></strong></p>
                        {{Form::select(
                              'user_id',
                              ['' => 'Chagua moja'] + $users,
                              '',
                              ['required'=>'required', 'class'=>"form-control", 'id'=>'user_id']
                          )}}
                       
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="song_id" value="{{ $song->id }}">

                        <button type="submit" class="btn btn-primary">Endelea >></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@section('footer')
    <script type="text/javascript" src="/js/fastselect.standalone.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user_id').fastselect();
        });
    </script>
    
@stop
@stop