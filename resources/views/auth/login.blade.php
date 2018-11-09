@extends('layouts.front-end')
@section('header')
    
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5" >
            <h2>Ingia</h2>
            <form method="post" action="/login" id="composer-email-form">
                <div class="form-group">
                  <label for="email">Email yako</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email yako">
                </div>

                <div class="form-group">
                  <label for="password">Email yako</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Email yako">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name ='maoni' class ='maoni' />
                      <button type="submit" class="btn btn-primary">Ingia</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-5">
            <h2>Jisajili</h2>
            <form method="post" action="/login" id="composer-email-form">
                <div class="form-group">
                  <label for="email">Email yako</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email yako">
                </div>

                <div class="form-group">
                  <label for="password">Email yako</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Email yako">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name ='maoni' class ='maoni' />
                      <button type="submit" class="btn btn-primary">Ingia</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop