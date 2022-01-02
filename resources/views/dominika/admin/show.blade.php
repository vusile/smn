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

                <strong>Tarehe ya Dominika:</strong> {{date("d-m-Y", strtotime($dominika->dominika_date))}}<br /><br />
                <form method="post" action="/admin/dominikas/update-date/{{$dominika->id}}">
                    <label for="dominika_date">Badili Tarehe: </label>
                    <input type="date" name="dominika_date" id="dominika_date" min="{{date('Y-m-d')}}" value="{{date("Y-m-d", strtotime($dominika->dominika_date))}}" />

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit">Badili tarehe</button>

                    <br /><br />
                </form>

                <div class="container">
                    <form method="post" action="/admin/dominikas/delete/{{$dominika->id}}">
                        <strong>Nyimbo za Mwanzo:</strong> <a href ="/admin/dominikas/add-songs/mwanzo/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $mwanzo) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {!! songLink($song) !!} - {{$song->composer->name}}<br />
                        @endforeach
                        <br />
                        <button type="submit">Delete</button>
                        <br /><br />

                        <br /><strong>Nyimbo za Katikati:</strong> <a href ="/admin/dominikas/add-songs/katikati/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $katikati) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {!! songLink($song) !!}  - {{$song->composer->name}}<br />
                        @endforeach
                        <br />
                        <button type="submit">Delete</button>
                        <br /><br />


                        <br/><strong>Shangilio:</strong> <a href ="/admin/dominikas/add-songs/shangilio/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $shangilio) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {!! songLink($song) !!} - {{$song->composer->name}}<br />
                        @endforeach
                        <br />
                        <button type="submit">Delete</button>
                        <br /><br />

                        <br /><strong>Antifona / Komunio:</strong> <a href ="/admin/dominikas/add-songs/antifona/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        @foreach($approvedDominikaSongs->whereIn('id', $antifona) as $song)
                            <input type="checkbox" name="delete[]" value="{{$song->id}}"> {!! songLink($song) !!} - {{$song->composer->name}}<br />
                        @endforeach
                        <br />
                        <button type="submit">Delete</button>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@stop
