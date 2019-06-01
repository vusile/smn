@extends('layouts.front-end')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tafadhali tupe namba ya simu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save-number') }}">
                        @csrf


                        
                        
                        

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Namba ya simu</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                <small>Tafadhali usisahau kuweka code ya nchi (+255 au +254) mfano +<strong>255</strong>711123456 au +<strong>254</strong>711123456</small>
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
