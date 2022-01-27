@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
    <script type="text/javascript">
        function toggle(source, prefix) {
            checkboxes = document.querySelectorAll("input[name^='changeStatus[']")
            for(var i=0, n=checkboxes.length;i<n;i++) {
                if(checkboxes[i].getAttribute('id').includes(prefix)) {
                    checkboxes[i].checked = source.checked;
                }
            }
        }
    </script>
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
                <h1>{{$dominika->title}}</h1>
                <strong>Tarehe ya Dominika:</strong> {{date("d-m-Y", strtotime($dominika->dominika_date))}}<br /><br />
                <form method="post" action="/admin/dominikas/update-date/{{$dominika->id}}">
                    <label for="dominika_date">Badili Tarehe: </label>
                    <input type="date" name="dominika_date" id="dominika_date" min="{{date('Y-m-d')}}" value="{{date("Y-m-d", strtotime($dominika->dominika_date))}}" />

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit">Badili tarehe</button>

                    <br /><br />
                </form>

                <div class="container">
                    <form method="post" action="/admin/dominikas/change-status/{{$dominika->id}}">
                        <strong>Nyimbo za Mwanzo:</strong> <a href ="/admin/dominikas/add-songs/mwanzo/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        <input type="checkbox" onClick="toggle(this, 'mwanzo')" /> Chagua zote<br/>
                        @foreach($approvedDominikaSongs->whereIn('id', $mwanzo) as $song)
                            <input id="mwanzo-{{$song->id}}" type="checkbox" name="changeStatus[]" value="{{$song->id}}"> <a href="{!! downloadLink($song, 'pdf') !!}">{{$song->name}}</a> - {{$song->composer->name}} >>
                            @if($statuses[$song->id])
                                <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @else
                                <a href = "/admin/review-dominika/approve/{{$song->id}}/{{$dominika->id}}">SAWA</a> ---- <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @endif
                        @endforeach
                        <br />
                        <input type="hidden" name="parts_of_mass_id" value="1">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" name="submit" value="delete">Delete</button>
                        <button type="submit" name="submit" value="approve">Approve</button>
                        <br /><br />
                    </form>

                    <form method="post" action="/admin/dominikas/change-status/{{$dominika->id}}">
                        <br /><strong>Nyimbo za Katikati:</strong> <a href ="/admin/dominikas/add-songs/katikati/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        <input type="checkbox" onClick="toggle(this, 'katikati')" /> Chagua zote<br/>
                        @foreach($approvedDominikaSongs->whereIn('id', $katikati) as $song)
                            <input id="katikati-{{$song->id}}" type="checkbox" name="changeStatus[]" value="{{$song->id}}"> <a href="{!! downloadLink($song, 'pdf') !!}">{{$song->name}}</a>  - {{$song->composer->name}} >>
                            @if($statuses[$song->id])
                                <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @else
                                <a href = "/admin/review-dominika/approve/{{$song->id}}/{{$dominika->id}}">SAWA</a> ---- <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @endif
                        @endforeach
                        <br />
                        <input type="hidden" name="parts_of_mass_id" value="2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" name="submit" value="delete">Delete</button>
                        <button type="submit" name="submit" value="approve">Approve</button>
                        <br /><br />
                    </form>

                    <form method="post" action="/admin/dominikas/change-status/{{$dominika->id}}">
                        <br/><strong>Shangilio:</strong> <a href ="/admin/dominikas/add-songs/shangilio/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        <input type="checkbox" onClick="toggle(this, 'shangilio')" /> Chagua zote<br/>
                        @foreach($approvedDominikaSongs->whereIn('id', $shangilio) as $song)
                            <input id="shangilio-{{$song->id}}" type="checkbox" name="changeStatus[]" value="{{$song->id}}"> <a href="{!! downloadLink($song, 'pdf') !!}">{{$song->name}}</a> - {{$song->composer->name}} >>
                            @if($statuses[$song->id])
                                <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @else
                                <a href = "/admin/review-dominika/approve/{{$song->id}}/{{$dominika->id}}">SAWA</a> ---- <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @endif
                        @endforeach
                        <br />
                        <input type="hidden" name="parts_of_mass_id" value="3">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" name="submit" value="delete">Delete</button>
                        <button type="submit" name="submit" value="approve">Approve</button>
                        <br /><br />
                    </form>
                    <form method="post" action="/admin/dominikas/change-status/{{$dominika->id}}">
                        <br /><strong>Antifona / Komunio:</strong> <a href ="/admin/dominikas/add-songs/antifona/{{$dominika->id}}">Ongeza nyingine</a><br /><br />
                        <input id="antifona-{{$song->id}}" type="checkbox" onClick="toggle(this, 'shangilio')" /> Chagua zote<br/>
                        @foreach($approvedDominikaSongs->whereIn('id', $antifona) as $song)
                            <input type="checkbox" name="changeStatus[]" value="{{$song->id}}"> <a href="{!! downloadLink($song, 'pdf') !!}">{{$song->name}}</a> - {{$song->composer->name}} >>
                            @if($statuses[$song->id])
                                <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @else
                                <a href = "/admin/review-dominika/approve/{{$song->id}}/{{$dominika->id}}">SAWA</a> ---- <a href = "/admin/review-dominika/deny/{{$song->id}}/{{$dominika->id}}">SI SAWA</a><br />
                            @endif
                        @endforeach
                        <br />
                        <input type="hidden" name="parts_of_mass_id" value="4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" name="submit" value="delete">Delete</button>
                        <button type="submit" name="submit" value="approve">Approve</button>

                    </form>
                </div>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@stop
