@extends('layouts.front-end')

@section('header')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Simu - <small>Namba hizi si mawasiliano ya mtunzi, ni ya SMN</small></div>
                <div class="card-body">
                    Tigo: +255 657 867 793 (ina WhatsApp)<br>
                    Voda: +255 768 205 729<br>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Wasiliana Na SMN</div>

                
                <div class="card-body">
                    <form method="POST" action="{{ route('send-message') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Jina</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Namba ya simu</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" >

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email yako</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Ujumbe wako</label>

                            <div class="col-md-6">
                                <textarea id="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" value="{{ old('message') }}" required></textarea>

                                @if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="6LfmUYAUAAAAAMRJDZX7NR784FH74RRz0brOYh4G"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="text" name ='maoni' class ='maoni' />
                                <button type="submit" class="btn btn-primary">
                                    Tuma Ujumbe
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
