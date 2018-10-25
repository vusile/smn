@extends('layouts.front-end')
@section('content')
@include('layouts.account-menu')
<div class="container">
    <div class="row">
        
        <div class="col-lg-8" >
            <br />
            <br />
            <h2>Pakia wimbo</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="get" action="/upload/details" id="composer-email-form">
                <div class="form-group">
                  <label for="name">Jina la wimbo</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Jina la Wimbo" required="">
                </div>

                <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="composer_id">Jina la Mtunzi</label>
                        {{Form::select(
                              'composer_id',
                              ['' => 'Chagua moja'] + $composers,
                              request('selected_composer'),
                              ['required'=>'required', 'class'=>"form-control"]
                          )}}
                    </div>
                    <div class="col-sm-4">
                        <br>
                        <br>
                        <a href="/mtunzi/create?from-song=1">Mtunzi hayumo kwenye orodha</a>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <button type="submit" class="btn btn-primary">Endelea >></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@stop