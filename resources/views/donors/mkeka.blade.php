@extends('layouts.backend-end')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Michango ya {{ $date->monthName }} {{ $date->year }}</h1>
    </div>

    <div class="container">
    <a href="/admin/mkeka?minus={{$minus}}&plus={{request('plus')}}">Rudi Mwezi mmoja</a> | <a href="/admin/mkeka?plus={{$plus}}&minus={{request('minus')}}">Nenda mbele Mwezi mmoja</a>  <br /><br />

        <h2>Jumla ya michango mwezi wa {{ $date->monthName }} {{ $date->year }}: {{ number_format($monthlyTotal) }}</h2>

        @foreach($donors as $donor)
            {{$loop->index + 1}}. {{$donor->name}} -
            {{ isset($monthlyTotals[$donor->id]) ? number_format($monthlyTotals[$donor->id]) : 0 }}
            ({{ isset($totals[$donor->id]) ? number_format($totals[$donor->id]) : 0 }}) <br />
        @endforeach

        <a href="/admin/tuma-mkeka?date={{$date->format('Y-m-d')}}">Tuma Message</a>
    </div>
@stop
