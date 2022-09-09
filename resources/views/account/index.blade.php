@extends('layouts.backend-end')
@section('content')
<div class="notika-status-area">
        <div class="container">
            <div class="row">
{{--                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">--}}
{{--                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">--}}
{{--                        <div class="website-traffic-ctn">--}}
{{--                            <h2><span class="counter">{{number_format($pendingSongs + $activeSongs)}}</span></h2>--}}
{{--                            <p>Nyimbo Ulizoupload</p>--}}
{{--                        </div>--}}
{{--                        <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{number_format($activeSongs)}}</span></h2>
                            <p>Zilizo live</p>
                        </div>
                        <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{number_format($pendingSongs)}}</span></h2>
                            <p>Zilizo Pending</p>
                        </div>
                        <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$songsReviewed->count() ? number_format($songsReviewed->first()->reviewed) : 0}}</span></h2>
                            <p>Nyimbo ulizoreview</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                    </div>
                </div>
            </div>
            <div class ='row'>
                <div class="col-lg-6 col-md-8 col-sm-7 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <h2>Jinsi ya Ku-upload wimbo</h2>
                        <p>Jifunze jinsi ya ku-upload wimbo</p>
                        <div class="videoWrapper">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/GmRBZdyG168?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-7 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <h2>Jinsi ya Ku-review nyimbo</h2>
                        <p>Jifunze jinsi ya ku-review nyimbo</p>
                        <div class="videoWrapper">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/nc1TCbvxcZY?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
