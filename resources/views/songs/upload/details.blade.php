<?php
    $class = '';
    if($duplicates && !$errors->any()) {

        $class = 'collapse';
    }
?>
@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br /><br />
            <h2>Maelezo Mengine ya wimbo</h2>
            <p><strong>Jina la wimbo:</strong> {{$songName}}</p>
            <p><strong>Mtunzi:</strong> {{$composer->name}}</p>

            @if($duplicates)
            <p><strong>Inaonekana wimbo unaopakia upo tayari SMN. Angalia hapa:</strong></p>
            @foreach($duplicates as $song)
                <p>{!! songLink($song)  !!} wa {{$composer->name}}</p>
            @endforeach
            <p><strong>Je ni kwa nini unapakia tena?</strong></p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#upload-song-details" aria-expanded="false" aria-controls="upload-song-details">Uliopo una makosa</button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#upload-song-details" aria-expanded="false" aria-controls="upload-song-details">Majina yanafanana tu</button>
                <a class="btn btn-primary" href="/akaunti" >Sihitaji kupakia tena</a>
                <br>
                <br>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="{{$class}} needs-validation" method="post" action="/upload/store" id="upload-song-details" novalidate enctype='multipart/form-data'>
                @if(!$composer->composer_alive)
                    <div class="form-group">
                        <p><strong>Mtunzi wa wimbo huu yupo hai?</strong></p>
                        <input class="form-check-input" name="composer_alive" type="radio" id="composer_alive_yes" value="yes" @if(old('composer_alive') == "yes") checked="checked" @endif>
                        <label class="form-check-label" for="composer_alive_yes">Ndio&nbsp;&nbsp;&nbsp;&nbsp;</label>

                        <input class="form-check-input" name="composer_alive" type="radio" id="composer_alive_no" value="no" @if(old('composer_alive') == "no") checked="checked" @endif>
                        <label class="form-check-label" for="composer_alive_no">Hapana&nbsp;&nbsp;&nbsp;&nbsp;</label>

                        <input class="form-check-input" name="composer_alive" type="radio" id="composer_alive_not_sure" value="sijui">
                        <label class="form-check-label" for="composer_alive_not_sure">Sijui</label>
                    </div>
                @endif

                <div class="form-group">
                      <p><strong>Pakia PDF:</strong></p>
                      <input type="file" class="form-control-file" id="pdf" name="pdf" required="">
                </div>

                <div class="form-group">
                    <p><strong>Pakia Midi: <a target="_blank" href="https://www.youtube.com/watch?v=KjGTC3oJ_YA">Namna ya kutengeneza Midi</a></strong></p>
                    <input type="file" class="form-control-file" id="midi" name="midi" >
                </div>

                <div class="form-group">
                    <p><strong>Maneno ya wimbo:</strong></p>
                    <textarea id="summernote" name="lyrics"></textarea>
                </div>


                <div class="form-group">
                    <p><strong>Makundi Nyimbo: Jaribu usizidishe 3</strong></p>

                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" name="categories[]" type="checkbox" id="{{$category->id}}" value="{{$category->id}}">
                                  <label class="form-check-label" for="{{$category->id}}">{{$category->title}}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <p><strong>Umetumia software gani kuandika wimbo? - <a href="">Namna ya kupata file la software</a></strong></p>
                  {{Form::select(
                        'software_id',
                        ['' => 'Chagua moja'] + $softwares,
                        null,
                        ['class'=>"form-control"]
                    ) }}
                </div>

                <div class="form-group">

                    <div class ="col">
                        <label for="software_file">Pakia file la software</label>
                        <input type="file" class="form-control-file" id="software_file" name="software_file" >
                    </div>
                    <div class ="col">
                    </div>

                </div>

                    <div class="form-group">
                        <p><strong>Je unazo nota zilizo andikwa kwa mkono wa mtunzi? Kama ndio, zipakie</strong></p>
                         <div class="custom-file">

                            <div class ="col">

                                <input type="file" class="form-control-file" id="nota_original" name="nota_original" >
                            </div>
                            <div class ="col">
                            </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="name" value="{{$songName}}">
                        <input type="hidden" name="composer_id" value="{{$composer->id}}">
                        <input type="hidden" name="duplicates" value="{{ implode(',', collect($duplicates)->keys()->all()) }}" />

                        <button type="submit" class="btn btn-primary">Endelea >></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>

    </div>
</div>

@section('footer')
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(document).ready(function() {
           $('#summernote').summernote({
                height: 200,
                popover: {
                    image: [],
                    link: [],
                    air: []
                },
                toolbar: [
                   ['style', ['bold', 'italic', 'underline', 'clear']],
                   ['para', ['ul', 'ol', 'paragraph']]
               ]
           });
        });
    </script>
@stop
@stop
