@foreach($composerDuplicates as $composerDuplicate)
    <div class="form-check">
        <label class="form-check-label" for="composer-{{$composerId}}" >
            <input @if($loop->iteration == 1) checked @endif type="radio" name ="composer-{{$composerId}}" id ="composer-{{$composerId}}" value="{{$composerDuplicate->id}}" /> {{$composerDuplicate->name}} - {{$composerDuplicate->active_songs}}
        </label>
    </div>
@endforeach
    <div class="form-check">
        <label class="form-check-label" for="composer-{{$composerId}}" >
            <input type="radio" name ="composer-{{$composerId}}" id ="composer-{{$composerId}}" value="ignore" /> Ignore hizi duplicates
        </label>
    </div>
<br />