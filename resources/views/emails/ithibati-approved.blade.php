@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Wimbo Umepata Ithibati: {{ $song->name }}
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        Tumsifu Yesu Kristu {{ $song->user->first_name }},<br><br>
        
        Wimbo wa {{ $song->name }} uliopakia sasa umepata Ithibati.<br><br>
        
        <strong>Namba ya Ithibati ni:</strong> {{ $song->ithibati_number }}.<br><br>
        
        @if($song->status == 7)
            Kwa kuwa wimbo huu utarekodiwa, basi hautaonekana kwenye SMN mpaka utakaposema uonekane.
        @else
            Wimbo huu kuanzia sasa unapatikana SMN.
        @endif
        <br><br>

        @if($showChanges)
            Muhakiki amefanya mabadiliko yafuatayo:<br>
            @foreach($song->revisionHistory as $history )
                @if($history->userResponsible()->hasRole('uhakiki'))
                <li><em>{{ $history->fieldName() }}</em>: <br>Kutoka <strong>{{ $history->oldValue() }}</strong><br>kuwa <strong>{{ $history->newValue() }}</strong></li>
                <br>
                @endif
            @endforeach
            <br><br>
        @endif
            
        @if($songReview && $songReview->comments)
            Aliyehakiki ameacha maoni yafuatayo:<br><br>
            <em>{{$songReview->comments}}</em>
            <br><br>
        @endif
        
        Tafadhali bofya link ifuatayo ili kuuona &gt; {!! songLink($song) !!}<br><br>
        
        Wako katika Kristu,
        
        <br><br>
        <strong>Admin<br>
            Swahili Music Notes</strong>
    </p>
    <br />
    <br />

@stop   