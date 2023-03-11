@extends('layouts.front-end')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Jibu Maswali yafuatayo. Maswali haya yatatumika indapo utasahau password yako</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('save_password_reset_questions')}}">
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
                                    <button type="submit" class="btn btn-primary">
                                        Hifadhi Majibu
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
