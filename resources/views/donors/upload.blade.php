@extends('layouts.backend-end')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Upload Excel Kutoka Changisha Au Mkoba</h1>
    </div>

    <div class="container">

        @if (session('message', null))
            <div class="alert alert-success" role="alert">
                {{session('message', null)}}
            </div>
        @endif

            <livewire:upload-reports />
    </div>
@stop
