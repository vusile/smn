@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Umefanikiwa kupakia wimbo: {{ $song->name }}
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        Tumsifu Yesu Kristu {{ $song->user->first_name }},<br><br>
        
        Wimbo wa {{ $song->name }} uliopakia sasa upo kwenye Tovuti.<br><br>
        
        @if($song->revisionHistory)
            Mabadiliko yafuatayo yalifanyika:
            
            @foreach($song->revisionHistory as $history )
                <li>{{ $field_mappings[$history->fieldName()] }} ilibadilishwa kutoka <strong>{{ $history->oldValue() }}</strong> kuwa <strong>{{ $history->newValue() }}</strong></li>
            @endforeach
            <br><br>
        @endif
        
        @if($songReview->comment)
            Aliyehakiki ameacha maoni yafuatayo:<br><br>
            {{$songReview->comment}}
        @endif
        
        Tafadhali bofya link ifuatayo ili kuuona &gt; {!! songLink($song) !!}<br><br>
        
        <strong>N.B.</strong>&nbsp;Swahili Music Notes ina email ya baadhi ya watunzi. Kila unapo-upload wimbo wa mtunzi fulani, mtunzi huyo hutumiwa email kumuomba aukague, iwapo baada ya kuupitia atagundua kuwa wimbo huo una makosa, basi itanilazimu kuutoa wimbo huu kutoka kwenye site na kukujulisha marekebisho hayo ili urekebishe. Tafadhali tuwe tayari kusaidiana katika kuboresha chombo chetu.
        <br><br>
	Wako katika Kristu,
        
        <br><br>
        <strong>Admin<br>
            Swahili Music Notes</strong>
    </p>
    <br />
    <br />

@stop   