@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-lg-8" >
            <br />
            <br />
            <h2>Taarifa za mtunzi</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (isset($duplicates))
                <div class="alert alert-danger">
                    <p><strong>Mtunzi unayemuongeza yupo tayari. Chagua jina lake!</strong></p>
                    <ul>
                        @foreach($duplicates as $composer)
                        <li><a href ="/upload/song?selected_composer={{$composer->id}} ">{{ $composer->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="/mtunzi/store" id="composer-email-form" enctype='multipart/form-data'>
                <div class="form-group">
                  <label for="name">Jina la mtunzi</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Jina la Mtunzi" required="">
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="uploader_is_composer" name="uploader_is_composer">
                    <label class="form-check-label" for="uploader_is_composer">Mimi ndio huyu mtunzi</label>
                </div>
                
                <div class="form-group">
                  <label for="email">Barua Pepe</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Jina la Mtunzi" >
                </div>
                
                <div class="form-group">
                  <label for="phone">Namba ya simu</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Namba ya simu" >
                </div>
                
                <div class="form-group">
                  <label for="jimbo">Jimbo:</label>
                  <input type="text" class="form-control" id="jimbo" name="jimbo" placeholder="Jimbo analotoka" >
                </div>
                
                <div class="form-group">
                  <label for="parokia">Parokia:</label>
                  <input type="text" class="form-control" id="parokia" name="parokia" placeholder="Parokia anayotoka" >
                </div>
                
                <div class="form-group">
                      <p><strong>Picha 1:</strong></p>
                      <input type="file" class="form-control-file" id="photo1" name="photo1" >
                </div>
                
                <div class="form-group">
                      <p><strong>Picha 2:</strong></p>
                      <input type="file" class="form-control-file" id="photo2" name="photo2" >
                </div>

                <div class="form-group">
                      <p><strong>Picha 3:</strong></p>
                      <input type="file" class="form-control-file" id="photo3" name="photo3" >
                </div>
                
                <div class="form-group">
                    <p><strong>Wasifu:</strong></p>
                    <textarea id="summernote" name="details"></textarea>
                </div>
               

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="added_by" value="{{ auth()->user()->id }}">
                        @if(request('from-song'))
                            <input type="hidden" name="return_to_song_upload" value="1">
                        @endif
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