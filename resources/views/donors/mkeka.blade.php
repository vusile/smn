@extends('layouts.backend-end')
@section('content')
    <script>
        window.onload = function() {
            var copyBtn = document.getElementById('btn');

            copyBtn.addEventListener('click', function (event) {
                let text = document.getElementById('message').innerHTML
                copyToClipboard((text));
            });
        }

        function copyToClipboard(html) {
            var container = document.createElement('div')
            container.innerHTML = html
            container.style.position = 'fixed'
            container.style.pointerEvents = 'none'
            container.style.opacity = 0
            document.body.appendChild(container)
            window.getSelection().removeAllRanges()
            var range = document.createRange()
            range.selectNode(container)
            window.getSelection().addRange(range)
            document.execCommand('copy')
            document.body.removeChild(container);
            document.getElementById('success').innerHTML = "Umefanikiwa kucopy";
        }
    </script>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Michango ya {{ $date->monthName }} {{ $date->year }}</h1>
    </div>

    <div class="container">
    <a href="/admin/mkeka?minus={{$minus}}&plus={{request('plus')}}">Rudi Mwezi mmoja</a> | <a href="/admin/mkeka?plus={{$plus}}&minus={{request('minus')}}">Nenda mbele Mwezi mmoja</a>  <br /><br />

        <button id="btn" >Copy Mkeka!</button>
        <br><br>
        <div style="color: seagreen; font-weight: bold; font-size: 24px" id="success"></div>
        <div style="color: red; font-weight: bold; font-size: 24px" id="failure"></div>

        <h2>Jumla ya michango mwezi wa {{ $date->monthName }} {{ $date->year }}: {{ number_format($monthlyTotal) }}</h2>

        @foreach($donors as $donor)
            {{$loop->index + 1}}. {{$donor->name}} -
            {{ isset($monthlyTotals[$donor->id]) ? number_format($monthlyTotals[$donor->id]) : 0 }}
            ({{ isset($totals[$donor->id]) ? number_format($totals[$donor->id]) : 0 }}) <br />
        @endforeach

    </div>
@stop

<div id = "message" style="display: none">
    {!! $message !!}
</div>
