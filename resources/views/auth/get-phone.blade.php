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

                            @include('auth.partials.phone-field')
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
