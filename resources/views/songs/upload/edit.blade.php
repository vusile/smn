@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br /><br />
            <h2>Badili maelezo ya wimbo</h2>
                
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="needs-validation" method="post" action="/upload/update" id="upload-song-details" novalidate enctype='multipart/form-data'>
                <div class="form-group">
                  <label for="name">Jina la wimbo</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Jina la Wimbo" required="" value="{{$song->name}}">
                </div>

                <div class="form-group">
                    <label for="composer_id">Jina la Mtunzi</label>
                    {{Form::select(
                          'composer_id',
                          ['' => 'Chagua moja'] + $composers,
                          $song->composer->id,
                          ['required'=>'required', 'class'=>"form-control", 'id' =>'composer_id']
                    )}}
                </div>
                
                <p><strong>PDF: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'pdf')}}" role="button">Download Nota Uhakiki</a></p>
           
                <div class="form-group">
                    <p><strong>Pakia PDF kama unataka kubadili iliyopo:</strong></p>
                    <input type="file" class="form-control-file" id="pdf" name="pdf" required="">
                </div>
                
                @if($song->midi)
                    <br><p><strong>Midi: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'midi')}}" role="button">Download Midi Uhakiki</a></p>
                @endif
                
                <div class="form-group">
                    <p><strong>Pakia Midi kama unataka kubadili iliyopo: <a target="_blank" href="https://www.youtube.com/watch?v=KjGTC3oJ_YA">Namna ya kutengeneza Midi</a></strong></p>
                    <input type="file" class="form-control-file" id="midi" name="midi" >
                </div>
                
                <div class="form-group">
                    <p><strong>Maneno ya wimbo:</strong></p>
                    <textarea id="summernote" name="lyrics">
                        {{$song->lyrics}}
                    </textarea>
                </div>
                
                
                <div class="form-group" id='categories'>
                    <p><strong>Makundi Nyimbo: Jaribu usizidishe 3</strong></p>

                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" name="categories[]" type="checkbox" id="{{$category->id}}" value="{{$category->id}}" @if(in_array($category->id, $selectedCategories)) checked = 'checked' @endif >
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
                        $song->software_id,
                        ['class'=>"form-control"]
                    ) }}
                </div>

                @if($song->software_file)
                    <br><p><strong>File la software: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'software_file')}}" role="button">Download File la Software Uhakiki</a></p>
                @endif
                                
                <div class="form-group">
                    <div class ="col">
                        <label for="software_file">Pakia file la software kama unataka kubadili</label>
                        <input type="file" class="form-control-file" id="software_file" name="software_file" >
                    </div>
                    <div class ="col">
                    </div>

                </div>

                @if($song->nota_original)
                    <br><p><strong>Original: </strong> <a class="btn btn-primary" href="{{downloadLink($song, 'nota_original')}}" role="button">Download Original Uhakiki</a></p>
                @endif
                <div class="form-group">
                    <p><strong>Je unazo nota zilizo andikwa kwa mkono wa mtunzi? Kama ndio, zipakie au ubadili zilizopo</strong></p>
                     <div class="custom-file">
                        <div class ="col">
                            <input type="file" class="form-control-file" id="nota_original" name="nota_original" >
                        </div>
                        <div class ="col">
                        </div>
                    </div>
                </div>
                <br><br>
                @if(!request()->get('return'))
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" name="allowed_to_edit" type="checkbox" id="allowed_to_edit" value="1">
                                  <label style="color:red" class="form-check-label" for="allowed_to_edit">Natoa Ruhusa kamati ya uhakiki/ithibati kubadili / kuboresha wimbo iwapo itahitajika</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-10">
                        @if(request()->get('return'))
                            <input type="hidden" name="return" value="{{ request()->get('return') }}">
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="song_id" value="{{ $song->id }}">
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