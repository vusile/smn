@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br /><br />
            <h2>Tengeneza Ukurasa</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="needs-validation" method="post" action="/admin/pages/update/{{$blogPost->id}}" id="upload-song-details" novalidate enctype='multipart/form-data'>
                <div class="form-group">
                  <label for="title">Kichwa cha habari</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Kichwa cha Habari" required="" value="{{ $blogPost->title }}">
                </div>

                <div class="form-group">
                    <label for="text">Maelezo</label>
                    <textarea id="summernote" name="text">{{  $blogPost->text }}</textarea>
                </div>

                <div class="form-group">
                    <label for="type">Aina ya Taarifa:</label>
                    <select name = "type" class="form-control">
                        <option value = ''></option>
                        <option value = '3' @if($blogPost->type == 3 ) selected @endif>Taarifa ya TEC</option>
                        <option value = '2' @if($blogPost->type == 2 ) selected @endif>Taarifa ya SMN</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="document">@if($blogPost->document) <a class="btn btn-secondary" href="{{ asset('storage/documents/' . $blogPost->document) }}">Pakua Taarifa. </a>Kama unataka kubadili PDF pakia hapa @else Pakia Taarifa @endif</label>
                    <input type="file" class="form-control-file" id="document" name="document" >
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Save >></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2"></div>

    </div>
</div>

@section('footer')
    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
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
