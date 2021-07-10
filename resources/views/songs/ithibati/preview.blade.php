@extends('layouts.backend-end')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >
                <br />
                <h3>Ithibati</h3>
                <br />
                <p><strong>Jina la wimbo: </strong> {{ $song->name }}</p>
                <p><strong>Mtunzi: </strong> {{ $song->composer->name }}</p>

                @if($song->ithibati_number)
                    <p><strong>Namba ya Ithibati: </strong> {{ $song->ithibati_number }}</p>
                @else
                    <p><strong>Wimbo haujapata ithibati</strong></p>
                @endif



                <a class="btn btn-primary" href="/akaunti/toa-ithibati" >Endelea na Wimbo Mwingine</a>

            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>

@stop
