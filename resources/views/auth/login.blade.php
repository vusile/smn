@extends('layouts.front-end')
@section('header')
    
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h2>Jisajili</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('register') }}" id="composer-email-form">
                <div class="form-group">
                  <label for="first_name">Jina la kwanza</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Jina la kwanza">
                </div>
                
                <div class="form-group">
                  <label for="last_name">Jina la pili</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Jina la pili">
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
                  <label for="confirm_email">Andika tena Email yako</label>
                  <input type="email" class="form-control" id="email_confirmation" name="email_confirmation" placeholder="Andika tena Email yako">
                </div>

                <div class="form-group">
                  <label for="password">Neno siri (Password)</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                
                <div class="form-group">
                  <label for="confirm_password">Rudia tena neno siri (Rudia Password)</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name ='maoni' class ='maoni' />
                      <button type="submit" class="btn btn-primary">Jisajili</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-5" >
            <h2>Ingia</h2>
            <form method="post" action="/login" id="composer-email-form">
                <div class="form-group">
                  <label for="email">Email yako</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email yako">
                </div>

                <div class="form-group">
                  <label for="password">Neno siri (Password)</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name ='maoni' class ='maoni' />
                      <button type="submit" class="btn btn-primary">Ingia</button>
                    </div>
                </div>
            </form>
            <br><br>
            <h2>Umesahau Password?</h2>
            <form method="post" action="/password/forgot" id="composer-email-form">
                <div class="form-group">
                  <label for="email">Weka Email yako ili ubadili password</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email yako">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name ='maoni' class ='maoni' />
                        <button type="submit" class="btn btn-primary">Password Mpya</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop