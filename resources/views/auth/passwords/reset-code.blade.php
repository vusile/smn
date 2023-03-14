@extends('layouts.front-end')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Jaza ili ubadili password</div>

                <div class="card-body">
                    <form method="POST" action="/password/update/{{$user->id}}">
                        @csrf


                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Namba uliyotumiwa</label>

                            <div class="col-md-6">
                                @if(!$showCodeField)
                                    <input type="hidden" name="session_var" value="{{ base64_encode($user->verification_code) }}">
                                    <input type="hidden" name="mod_id" value="{{ base64_encode($user->id) }}">
                                @else
                                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $code ?? old('code') }}" required autofocus>
                                @endif

                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Rudia tena password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Badili Password
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
