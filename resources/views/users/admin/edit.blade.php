@extends('layouts.backend-end')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8" >
            <br /><br />
            <h2>Badili User</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="needs-validation" method="post" action="/admin/users/update/{{$user->id}}" id="upload-song-details" novalidate enctype='multipart/form-data'>
                <div class="form-group">
                  <label for="name">Jina la kwanza</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Jina la kwanza" required="" value="{{$user->first_name}}">
                </div>

                <div class="form-group">
                    <label for="name">Jina la Pili</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Jina la pili" required="" value="{{$user->last_name }}">
                </div>

                <div class="form-group">
                    <label for="name">Barua pepe</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Barua Pepe" required="" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="phone" >Namba ya simu moja tu</label>
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>

                </div>

                <div class="form-group row">
                    <label class="form-check-label col-md-4 col-form-label text-md-right" for="has_whatsapp">
                        Namba hii ina WhatsApp
                    </label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_whatsapp" id="has_whatsapp" value="1" @if($user->has_whatsapp) checked @endif>
                            <label class="form-check-label" for="has_whatsapp">
                                Ndio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="has_whatsapp" id="has_no_whatsapp" value="0" @if(!$user->has_whatsapp) checked @endif>
                            <label class="form-check-label" for="has_no_whatsapp">
                                Hapana
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-check-label col-md-4 col-form-label text-md-right" for="verified">
                        Verified
                    </label>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="phone_verified" id="verified" value="1" @if($user->phone_verified) checked @endif>
                            <label class="form-check-label" for="verified">
                                Ndio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="phone_verified" id="not_verified" value="0" @if(!$user->phone_verified) checked @endif>
                            <label class="form-check-label" for="not_verified">
                                Hapana
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="category_id" value="{{ $user->id }}">
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
