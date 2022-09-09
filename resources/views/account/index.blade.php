@extends('layouts.backend-end')
@section('content')
<div class="notika-status-area">

    </div>
@section('footer')
<style type="text/css">
    .videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
</style>
@stop
@stop
