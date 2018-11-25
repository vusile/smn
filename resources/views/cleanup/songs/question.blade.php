@foreach($songDuplicates as $songDuplicate)
    <div class="form-check">
        <label class="form-check-label" for="song-{{$songId}}" >
            <input @if($loop->iteration == 1) checked @endif type="radio" name ="song-{{$songId}}" id ="song-{{$songId}}" value="{{$songDuplicate->id}}" />
            <input @if($loop->iteration < 3) checked @endif type="checkbox" name ="include-song{{$songId}}[]" id ="include-song{{$songId}}[]" value="{{$songDuplicate->id}}" /> {!!songLink($songDuplicate)!!} - {{$songDuplicate->composer->name}} @if($songId == $songDuplicate->id)*@endif
                     
        </label>
    </div>
@endforeach
    <div class="form-check">
        <label class="form-check-label" for="song-{{$songId}}" >
            <input type="radio" name ="song-{{$songId}}" id ="song-{{$songId}}" value="ignore" /> Ignore sio duplicates
        </label>
    </div>
<br />