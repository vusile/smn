@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Wimbo: {{ $song->name }} unafanyiwa tathmini maalumu
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        Tumsifu Yesu Kristu {{ $song->user->first_name }},<br><br>
        
        Wimbo wako unafanyiwa tathmini  maalumu na kamati, na hivyo unaweza kuchelewa zaidi. Utajulishwa ukiwa tayari.<br><br>
        
        Wako katika Kristu,
        
        <br><br>
        <strong>Kamati ya Uhakiki<br>
            Swahili Music Notes</strong>
    </p>
    <br />
    <br />

@stop   