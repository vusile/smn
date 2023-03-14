
@extends('layouts.backend-end')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class=" needs-validation" method="post" action="{{route('whatsapp-send')}}" id="" novalidate enctype='multipart/form-data'>

                    <div class="form-group">
                        <label for="phone">Namba ya simu</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Namba ya Simu" required="">
                    </div>

                    <div class="form-group">
                        <p><strong>Chagua template moja</strong></p>
                        {{Form::select(
                              'template_name',
                              ['' => 'Chagua moja'] + $templates,
                              null,
                              ['class'=>"form-control"]
                          ) }}
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <button type="submit" class="btn btn-primary">Tuma >></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@stop
