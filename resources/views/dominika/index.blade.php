@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ $title }} </h1>
        <p class="lead">{{ $description }}.<br><br><strong>Dominika na Ibada za Karibuni:</strong></p>
        @include('dominika.partials.wiki-hii')
    </div>
<div class="container">
    @foreach($dominikas as $dominika)
        <div class="row  {{$loop->index%2 == 0 ? "bg-light" : "" }} ">
            <div class="col-lg-6" >
                <p><a href = "/dominika-sikukuu/{{Str::slug($dominika->title)}}/{{$dominika->id}}">{{ $dominika->title }}</a> - {{ $dominika->rangi }}</p>
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
@stop

