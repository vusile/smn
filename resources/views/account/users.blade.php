@extends('layouts.backend-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{$users->total()}}</h1>
</div>

<div class="container">
    <form class="needs-validation" method="get" action="/users/search" novalidate>
        <div class="form-group">
            <p><strong>Tafuta Uploader</strong></p>
            <input type="text" class="form-control" id="q" name="q" placeholder="Tafuta Uploader" value="{{request()->query('q')}}">
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">Tafuta</button>
            </div>
        </div>
    </form>
    
    @if (session('message', null))
        <div class="alert alert-success" role="alert">
            {{session('message', null)}}
        </div>
    @endif
    @foreach($users as $user)
        @include("users.partials.account-user-row")
    @endforeach
    {{ $users->links() }}
</div>
@stop
