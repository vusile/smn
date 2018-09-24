@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Umepokea maoni yafuatayo kwenye wimbo: {!! songLink($comment->song) !!}
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        <strong>Kutoka kwa:</strong> {{ $comment->name }} <br>
        
        @if($comment->email)
            <strong>Barua Pepe:</strong> {{ $comment->email }} <br>
        @endif
        
        @if($comment->phone)
            <strong>Namba ya simu:</strong> {{ $comment->phone }} <br>
        @endif
        
        <strong>Maoni yenyewe:</strong> {{ $comment->comment }} <br>
        
    </p>
    <br />
    <br />

@stop   