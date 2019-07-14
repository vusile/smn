{{$loop->iteration}}. 

@if($song->can_be_edited)
    {!! $question->question !!} <br />
@else
    {!! $question->question_no_permission ?? $question->question  !!} <br />
@endif

@if(isset($answers))
    @foreach($answers as $answer)
        <div class="form-check">
            <label class="form-check-label" for="answer{{$question->id}}{{$answer->id}}" >
                <input type="radio" name ="answer{{$question->id}}" id ="answer{{$question->id}}{{$answer->id}}" value="{{$answer->id}}" /> {{$answer->value}}
            </label>
        </div>
    @endforeach
    <div id="cm{{$question->id}}" class = 'form-group row'>
        <label class="col-sm-12 col-form-label">Tafadhali toa maelezo zaidi yamsaidie aliyepakia:</label><br>
        <textarea class="form-control" name="comment{{$question->id}}" id='comment{{$question->id}}'  rows="2"></textarea>
    </div>
@endif
<!--@if ($question->has_suggestion)
    <div id="cm{{$question->id}}" class = 'collapse form-group row'>
        <label class="col-sm-12 col-form-label">Tafadhali toa maelezo zaidi:</label><br>
        <textarea name="suggestion{{$question->id}}" id='comment{{$question->id}}'  rows="3"></textarea>
    </div>
@endif-->
<br />