{{$loop->iteration}}. {!! $question->question !!} <br />
@foreach($answers as $answer)
    <div class="form-check">
        <label class="form-check-label" for="answer{{$question->id}}{{$answer->id}}" @if($answer->id == 2) data-toggle="collapse" data-target="#cm{{$question->id}}" aria-expanded="false" aria-controls="cm{{$question->id}}" @endif>
            <input type="radio" name ="answer{{$question->id}}" id ="answer{{$question->id}}{{$answer->id}}" value="{{$answer->id}}" /> {{$answer->value}}
        </label>
    </div>
@endforeach
<div id="cm{{$question->id}}" class = 'form-group row'>
    <label class="col-sm-12 col-form-label">Tafadhali toa maelezo zaidi yamsaidie aliyepakia:</label><br>
    <textarea class="form-control" name="comment{{$question->id}}" id='comment{{$question->id}}'  rows="2"></textarea>
</div>
<!--@if ($question->has_suggestion)
    <div id="cm{{$question->id}}" class = 'collapse form-group row'>
        <label class="col-sm-12 col-form-label">Tafadhali toa maelezo zaidi:</label><br>
        <textarea name="suggestion{{$question->id}}" id='comment{{$question->id}}'  rows="3"></textarea>
    </div>
@endif-->
<br />