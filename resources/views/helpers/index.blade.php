@extends('layouts.backend-end')
@section('header')
    <link rel="stylesheet" href="/css/fastselect.min.css" />
@stop
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-8" >
                <br />
                <br />
                <h2>Chagua Wasaidizi:</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="/akaunti/save-helpers" id="addHelpers" name="addHelpers">

                    <div class="form-group row">
                        <div class="col-sm-8">
                            <p><strong>Chagua Wasaidizi</strong></p>
                            <select name = "helpers[]" id = "helpers" multiple>
                                <option value="">Chagua mmoja au zaidi</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" onclick='checkCount({{$loop->index}})'>{{ $user->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="helpable_type" value="{{ $helpableType }}">
                            <input type="hidden" name="helpable_id" value="{{ $helpableId }}">

                            <button type="submit" class="btn btn-primary">Endelea >></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
    @section('footer')
        <script type="text/javascript" src="/js/fastselect.standalone.min.js"></script>

        <script type="text/javascript">
            // $(document).ready(function() {
            //     $('#helpers').fastselect();
            // });

            function checkCount(j) {
                // alert("hahaha");
                var field = document.addHelpers.helpers;
                var total=0;
                for(var i=0; i < field.length; i++)
                {
                    if(field[i].selected)
                        total =total +1;
                }

                if(total > 3){
                    field[j].selected= false ;
                    alert("Tafadhali chagua watatu tu!")
                    return false;
                }

            }
        </script>
    @stop
@stop
