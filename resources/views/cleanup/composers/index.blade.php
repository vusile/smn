@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br />
            <h3>Watunzi waliojirudia:</h3>
            <br />
           
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="needs-validation" method="post" action="/remove-composer-duplicates" id="review-form" novalidate enctype='multipart/form-data'>
                @foreach($duplicates as $composerId => $composerDuplicates)
                    @include('cleanup.composers.question')
                    <input type="hidden" value="{{$composerDuplicates->pluck('id')->implode(',')}}" name="composer-{{$composerId}}-duplicates" />
                @endforeach
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="composer_ids" value="{{$composerIds}}">

                <button type="submit" class="btn btn-primary">Ondoa Duplicates</button>
            </form>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@stop