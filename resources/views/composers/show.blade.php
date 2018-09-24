@extends('layouts.front-end')
@section('header')
    <link rel="stylesheet" href="/css/custom.css" />
@stop
@section('content')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ $composer->name }}</h1>
        <p class="lead">{{ $description }}</p>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    
                    @if($composer->has_photo)
                        <div class="preview col-md-6">
                            <div class="preview-pic tab-content">
                                @if ($composer->photo)
                                    <div class="tab-pane active" id="pic-1">
                                        <img src="{{config('composer.files.paths.images')}}{{$composer->photo}}" />
                                    </div>
                                @endif
                                
                                @if ($composer->photo2)
                                    <div class="tab-pane" id="pic-2">
                                        <img src="{{config('composer.files.paths.images')}}{{$composer->photo2}}" />
                                    </div>
                                @endif
                       
                                @if ($composer->photo3)
                                    <div class="tab-pane" id="pic-3">
                                        <img src="{{config('composer.files.paths.images')}}{{$composer->photo3}}" />
                                    </div>
                                @endif
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @if ($composer->photo)
                                    <li class="active">
                                        <a data-target="#pic-1" data-toggle="tab">
                                            <img src="{{config('composer.files.paths.images')}}{{$composer->photo}}" />
                                        </a>
                                    </li>
                                @endif
                                @if ($composer->photo2)
                                    <li>
                                        <a data-target="#pic-2" data-toggle="tab">
                                            <img src="{{config('composer.files.paths.images')}}{{$composer->photo2}}" />
                                        </a>
                                    </li>
                                @endif
                                @if ($composer->photo3)
                                    <li>
                                        <a data-target="#pic-3" data-toggle="tab">
                                            <img src="{{config('composer.files.paths.images')}}{{$composer->photo3}}" />
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                        <div class="details col-md-6">
                            <h3 class="product-title">Maelezo zaidi</h3>

                            <p class="vote"><strong>Idadi ya nyimbo SMN: </strong> {{ $composer->songs->count() }} > <a href="/watunzi/nyimbo/{{$composer->url}}/{{$composer->id}}">Zitazame</a></p>
                            @if ($composer->jimbo)
                                <p class="vote"><strong>Jimbo analofanya utume: </strong> {{ $composer->jimbo }}</p>
                            @endif
                            @if ($composer->parokia)
                                <p class="vote"><strong>Parokia anayofanya utume: </strong> {{ $composer->parokia }}</p>
                            @endif
                            @if ($composer->phone)
                                <p class="vote"><strong>Namba ya simu: </strong> {{ $composer->phone }}</p>
                            @endif
                            
                            @if ($composer->details)
                                <strong><a href="#historia">Soma Historia na maelezo yake hapa</a></strong>
                            @endif
                            
                            @if ($composer->email)
                                <br><p class="vote"><strong>Wasiliana na mtunzi kwa email: </strong></p>
                            
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post" action="/composer-email" id="composer-email-form">
                                <div class="form-group">
                                  <label for="sender_name">Jina lako</label>
                                  <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="Jina lako" required="">
                                </div>

                                <div class="form-group">
                                  <label for="sender_phone">Namba ya simu</label>
                                  <input type="text" class="form-control" id="sender_phone" name="sender_phone" placeholder="Namba ya simu">
                                </div>

                                <div class="form-group">
                                  <label for="sender_email">Email yako</label>
                                  <input type="email" class="form-control" id="sender_email" name="sender_email" placeholder="Email yako">
                                </div>

                                <div class="form-group">
                                  <label for="message">Ujumbe wako</label>
                                  <textarea required="" class="form-control" id="message" name="message" rows="3" placeholder="Pongeza, Kosoa.... Uwe mstaarabu"></textarea>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" value='{{$composer->id}}' name ='composer_id' />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="text" name ='maoni' />
                                      <button type="submit" class="btn btn-primary">Tuma Ujumbe</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            
                        </div>
                    </div>
                </div>
                @if($composer->details)
                    <div class="row">
                        <div class="col-md-12">
                            <br><h3 class="product-title" id='historia'>Historia / Maelezo</h3>

                            <p class="vote"> {!! $composer->details !!}</p>
                        </div>
                    </div>
                @endif
            </div>
	</div>
    </div>
@stop
