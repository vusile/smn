@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Umepokea Ujumbe
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        <strong>Kutoka kwa:</strong> {{ $composerEmail->sender_name }} <br>
        
        <strong>Barua Pepe:</strong> {{ $composerEmail->sender_email }} <br>
        
        <strong>Namba ya simu:</strong> {{ $composerEmail->sender_phone }} <br>
        
        <strong>Ujumbe:</strong> {{ $composerEmail->message }} <br>
        
    </p>
    <br />
    <br />

@stop   