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

            <div class="container">
                @foreach($dominikas as $dominika)
                    <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
                        <div class="col-lg-6" >
                            <p><a href = "/admin/dominikas/{{$dominika->id}}">{{ $dominika->title }}</a> - {{ $dominika->rangi }}</p>
                        </div>
                        <div class="col-lg-4" >
                            <p>{{ $dominika->dominika_date? $dominika->dominika_date->format('d-m-Y') : '' }}</p>
                        </div>
                        <div class="col-lg-2" >
                            <p class="text-success">

                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>

    </div>
</div>
@stop
