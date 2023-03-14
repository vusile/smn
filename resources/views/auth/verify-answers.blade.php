@extends('layouts.front-end')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Jibu Maswali haya kama ulivyojibu siku ya kwanza</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('verify-answers')}}">
                            @csrf

                            @foreach($authQuestions as $authQuestion)
                                <div class="form-group row">
                                    <label for="answer{{$authQuestion->id}}" class="col-md-4 col-form-label text-md-left">
                                        {{$authQuestion->swahili}}<br />
                                        <small>{{$authQuestion->english}}</small>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="answer{{$authQuestion->id}}" type="text" class="form-control{{ $errors->has('answer'  . $authQuestion->id) ? ' is-invalid' : '' }}" name="answer{{$authQuestion->id}}" value="{{ old('answer' . $authQuestion->id) }}"  autofocus>

                                        @if ($errors->has('answer'  . $authQuestion->id) )
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer'  . $authQuestion->id) }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="text" name ='maoni' class ='maoni' />
                                    <input type="hidden" name ='mod_id'  value="{{ base64_encode($user->id) }}" />
                                    <input type="hidden" name ='questions'  value="{{ implode(',' , $authQuestions->pluck('id')->toArray()) }}" />
                                    <button type="submit" class="btn btn-primary">
                                        Hakiki Majibu
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
