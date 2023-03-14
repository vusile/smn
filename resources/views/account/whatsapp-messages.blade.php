@extends('layouts.backend-end')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"></h1>
    </div>

    <div class="container">
        @if (session('message', null))
            <div class="alert alert-success" role="alert">
                {{session('message', null)}}
            </div>
        @endif
        <div class="row  ">
            <div class="col-lg-3" >
                <p><strong>Phone Number</strong></p>
            </div>

            <div class="col-lg-3" >
                <p><strong>Message Type</strong></p>
            </div>
            <div class="col-lg-3" >
                <p><strong>Delivery Status</strong></p>
            </div>
            <div class="col-lg-3" >
                <p><strong>Message</strong></p>
            </div>
        </div>
        @foreach($whatsappMessages as $whatsappMessage)
            @include("whatsapp.partials.whatsapp-message-row")
        @endforeach
    </div>
@stop
