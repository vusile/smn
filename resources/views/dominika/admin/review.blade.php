@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10" >
            <br /><br />

            <div class="container">
                @foreach($songs as $song)
                    <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
                        <h2><a href="{!! downloadLink($song, 'pdf') !!}">{{$song->name}}</a> </h2>
                        @foreach($song->dominikas as $dominika)
                            <div class="row">
                                <p>{{$partsOfMass[$dominika->pivot->parts_of_mass_id]}} - <a href = "/dominika-sikukuu/{{Str::slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a> >> <a href = "/admin/review-dominika/approve/{{$song->id}}/{{$dominika->id}}">SAWA</a> ---- <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a></p>
                            </div>
                        @endforeach
                    </div>
                    <br><br>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2"></div>

    </div>
</div>
@stop
