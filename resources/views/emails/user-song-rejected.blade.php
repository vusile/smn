@extends('emails.email-layout')
@section('content')
<h3 style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">
    Wimbo wenye maneno {{ $song->name }} haujawawekwa kwenye tovuti.
</h3>
    <p class="lead" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">
        Tumsifu Yesu Kristu {{ $song->user->first_name }},<br><br>
        
        Baada ya wimbo {{$song->name}} kupitiwa na kufanyiwa uhakiki na watu watatu, matokeo ni yafuatayo. Tafadhali angalia taarifa ulizopata na uzifanyie kazi. Ili wimbo uende live, ni lazima upate walau 2/3 kwa maswali muhimu. Umefaulu maswali mengine yote isipokuwa yafuatayo:<br><br>
        
        @foreach($approvalQuestionScores as $approvalQuestion)
            @if(config('song.reviews.no_of_reviews_per_song') - $approvalQuestion->answers_count < 2)
                <p>
                    {!! $approvalQuestion->question !!}:<br>
                    <strong>Umepata {{config('song.reviews.no_of_reviews_per_song') - $approvalQuestion->answers_count}} / {{config('song.reviews.no_of_reviews_per_song')}} </strong>
                    
                    @if(isset($comments[$approvalQuestion->review_question_id]))
                        <br><br><strong>Mapendekezo</strong><br>
                        {!! $comments[$approvalQuestion->review_question_id] !!}
                    @endif
                </p>
            @endif
        @endforeach
        
        Tafadhali fanya marekebisho kama yalivyoelezwa.<br><br>
        Wako katika Kristu,
        
        <br><br>
        <strong>Admin<br>
            Swahili Music Notes</strong>
    </p>
    <br />
    <br />

@stop   