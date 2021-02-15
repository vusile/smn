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
                    <form method="post" action="/admin/dominikas/delete/{{$dominika->id}}">
                        <strong>Nyimbo za Mwanzo:</strong><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $mwanzo) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {{$song->name}} - {{$song->composer->name}}<br />
                        @endforeach

                        <br /><strong>Nyimbo za Katikati:</strong><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $katikati) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {{$song->name}} - {{$song->composer->name}}<br />
                        @endforeach

                        @if($shangilio)
                            <br/><strong>Shangilio:</strong><br /><br />
                            @foreach($approvedDominikaSongs->whereIn('id', $shangilio) as $song)
                                <input type="checkbox" name="delete[]" value="{{$song->id}}"> {{$song->name}} - {{$song->composer->name}}<br />
                            @endforeach
                        @endif

                        @if($antifona)
                            <br /><strong>Antifona / Komunio:</strong><br /><br />
                            @foreach($approvedDominikaSongs->whereIn('id', $antifona) as $song)
                                <input type="checkbox" name="delete[]" value="{{$song->id}}"> {{$song->name}} - {{$song->composer->name}}<br />
                            @endforeach
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@stop
