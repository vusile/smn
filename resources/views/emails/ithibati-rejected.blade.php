@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Wimbo wenye jina {{ $song->name }} haujapata Ithibati.
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        Tumsifu Yesu Kristu {{ $song->user->first_name }},<br><br>
        
        Baada ya wimbo {{$song->name}} kupitiwa na kufanyiwa uhakiki na kamati ya ithibati, Umeonekana unahitaji kufanyiwa marekebisho. Tafadhali fanyia kazi mapendekezo yafuatayo:<br>
        

        <p>
            <em><strong>{{$failedReview->comment}}</strong></em>
        </p>

        
        Tafadhali fanya marekebisho kama yalivyoelezwa.<br><br>
        Wako katika Kristu,
        
        <br><br>
        <strong>Kamati ya Uhakiki<br>
        UKWAKATA</strong>
    </p>
    <br />
    <br />

@stop   