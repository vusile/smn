@extends('layouts.front-end')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tafadhali thibitisha namba yako ya simu</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('verify-number') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="verification_code" class="col-md-4 col-form-label text-md-right">Namba ya Uhakiki</label>

                                <div class="col-md-6">
                                    <input id="verification_code" type="text" class="form-control{{ $errors->has('verification_code') ? ' is-invalid' : '' }}" name="verification_code" value="{{ old('verification_code') }}" required>

                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('verification_code') }}</strong>
                                    </span>
                                    @endif
                                    <small>Tafadhali angalia message kwenye number<strong>{{ auth()->user()->phone }}</strong></small>
                                </div>

                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="text" name ='maoni' class ='maoni' />
                                    <button type="submit" class="btn btn-primary">
                                        Hifadhi simu
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
