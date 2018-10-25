<?php
    $mwanzo = collect($parts)
        ->filter(function($part){
            return $part->id == 1;
        });
    
    $katikati = collect($parts)
        ->filter(function($part){
            return $part->id == 2;
        });
    
    $shangilio = collect($parts)
        ->filter(function($part){
            return $part->id == 3;
        });
    
    $antifona = collect($parts)
        ->filter(function($part){
            return $part->id == 4;
        });
    
?>
@extends('layouts.front-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
@include('layouts.account-menu')
<div class="container">
    <div class="row">
        <div class="col-lg-10" >
            <br /><br />
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if($parts)
            <h2>Nyimbo zenye maneno kama huu hutumika:</h2>
            <form class="needs-validation" method="post" action="/upload/dominika" id="upload-song-details" novalidate>
                @foreach($dominikas as $id => $name)
                    @if(isset($parts[$id]))
                        <p><strong>- {{$parts[$id]->name}} {{$name}}</strong></p>
                        @if($parts[$id]->id == 1)
                            <input type ="hidden" name="mwanzo[]" value="{{$id}}" />
                        @endif
                        @if($parts[$id]->id == 2)
                            <input type ="hidden" name="katikati[]" value="{{$id}}" />
                        @endif
                        @if($parts[$id]->id == 3)
                            <input type ="hidden" name="shangilio[]" value="{{$id}}" />
                        @endif
                        @if($parts[$id]->id == 4)
                            <input type ="hidden" name="antifona[]" value="{{$id}}" />
                        @endif
                    @endif
                @endforeach
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="song_id" value="{{$song->id}}">
                        <button type="submit" class="btn btn-primary">Na huu pia hutumika hivyo</button>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#dominika-form" aria-expanded="false" aria-controls="dominika-form">Hutumika na Dominika nyingine pia</button>
                        <a class="btn btn-primary" href="{{route('song-upload.preview', ['song' => $song])}}" >Hautumiki kwenye dominika</a>
                    </div>
                </div>
            </form>
            @endif
            
            <form class="@if($parts) collapse @endif needs-validation" method="post" action="/upload/dominika" id="dominika-form" novalidate  >
            <h2>Wimbo huu hutumika kwenye dominika au sikukuu?</h2>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <p><strong>Mwanzo:</a></strong></p>
                        {{Form::select(
                            'mwanzo[]',
                            $dominikas,
                            $mwanzo->keys()->toArray(),
                            [
                                'class' => 'form-control',
                                'multiple' => true,
                                'id' => 'mwanzo'
                            ]
                        ) }}
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-10">
                        <p><strong>Katikati:</a></strong></p>
                        {{Form::select(
                            'katikati[]',
                            $dominikas,
                            $katikati->keys()->toArray(),
                            [
                                'class' => 'form-control',
                                'multiple' => true,
                                'id' => 'katikati'
                            ]
                        ) }}
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-10">
                        <p><strong>Shangilio:</a></strong></p>
                        {{Form::select(
                            'shangilio[]',
                            $dominikas,
                            $shangilio->keys()->toArray(),
                            [
                                'class' => 'form-control',
                                'multiple' => true,
                                'id' => 'shangilio'
                            ]
                        ) }}
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-10">
                        <p><strong>Antifona:</a></strong></p>
                        {{Form::select(
                            'antifona[]',
                            $dominikas,
                            $antifona->keys()->toArray(),
                            [
                                'class' => 'form-control',
                                'multiple' => true,
                                'id' => 'antifona'
                            ]
                        ) }}
                    </div>
                </div>
                
              
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="song_id" value="{{$song->id}}">
                        <button type="submit" class="btn btn-primary">Maliza >></button>
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
            $('#mwanzo').fastselect();
            $('#katikati').fastselect();
            $('#shangilio').fastselect();
            $('#antifona').fastselect();
        });
    </script>
    
@stop
@stop