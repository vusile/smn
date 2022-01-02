@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10" >
                <br /><br />
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="needs-validation" method="get" action="/admin/dominikas/search" novalidate>
                    <div class="form-group">
                        <p><strong>Tafuta nyimbo za {{$part}} {{$dominika->title}}</strong></p>
                        <input type="text" class="form-control" id="q" name="q" placeholder="Tafuta wimbo" value="{{request()->query('q')}}">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="dominika" value="{{ $dominika->id }}">
                            <input type="hidden" name="part" value="{{ $part }}">
                            <button type="submit" class="btn btn-primary">Tafuta</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@stop
