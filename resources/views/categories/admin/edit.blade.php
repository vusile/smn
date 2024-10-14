@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br /><br />
            <h2>Badili Category</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="needs-validation" method="post" action="/admin/categories/update/{{$category->id}}" id="upload-song-details" novalidate enctype='multipart/form-data'>
                <div class="form-group">
                  <label for="name">Jina la Category</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Jina la Category" required="" value="{{$category->title}}">
                </div>

                <div class="form-group">
                    <label for="name">SEO title</label>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" placeholder="Jina la Category" required="" value="{{$category->seo_title}}">
                </div>

                <div class="form-group">
                    <label for="name">Maelezo</label>
                    <textarea id="summernote" name="description">
                        {{$category->description}}
                    </textarea>
                </div>

                <p><strong>Picha iliyopo: </strong> <img src="{{ config('categories.files.paths.icons') . $category->image }}"></p>

                <div class="form-group">
                    <p><strong>Pakia Picha kama unataka kubadili iliyopo:</strong></p>
                    <input type="file" class="form-control-file" id="image" name="image" required="">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
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
