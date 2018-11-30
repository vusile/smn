@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Umepokea ujumbe kutoka kwa: {{ $request->input('name') }}
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">

        @if($request->input('email'))
            <strong>Barua Pepe:</strong> {{ $request->input('email') }} <br>
        @endif
        
        @if($request->input('phone'))
            <strong>Namba ya simu:</strong> {{ $request->input('phone') }} <br>
        @endif
        
        <strong>Maoni yenyewe:</strong> {{ $request->input('message') }} <br>
        
    </p>
    <br />
    <br />

@stop   