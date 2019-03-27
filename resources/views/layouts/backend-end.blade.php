<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Akaunti - Swahili Music Notes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- owl.carousel CSS
        ============================================ -->
<!--    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">
    <link rel="stylesheet" href="/css/owl.transitions.css">-->
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/meanmenu/meanmenu.min.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/normalize.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/notika-custom-icon.css">
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/wave/waves.min.css">
    <link rel="stylesheet" href="/css/backend/wave/button.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/main.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="/css/backend/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="/js/backend/modernizr-2.8.3.min.js"></script>
    @section('header')
    @show
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="/"><img src="/images/swahili-music-notes-logo-site.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <h1>Karibu {{auth()->user()->first_name}}</h1>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                           <li class="nav-item dropdown">
                                <a href="/" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-left-arrow"></i></span> Rudi kwenye Tovuti</a>
                               
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a href="/akaunti">Home</a>
                                  
                                </li>
                                <li><a href="/upload/song">Pakia Wimbo</a>
                                    
                                </li>
                                <li><a href="/akaunti/nyimbo/live">Zipo Kwenye Tovuti</a>
                                </li>
                                <li><a href="/akaunti/nyimbo/pending">Subiri Review</a>
                                </li>
                                <li><a href="/akaunti/watunzi">Watunzi</a>
                                </li>
                                @can('kuhakiki')
                                <li><a href="/akaunti/review-nyimbo">Hakiki Nyimbo</a>
                                </li>
                                @endcan
                                @can('kutoa ithibati')
                                <li><a href="/akaunti/toa-ithibati">Toa Ithibati</a>
                                </li>
                                @endcan
                                @if(auth()->user()->hasAnyRole(['super admin', 'admin']))
                                <li><a href="/users"><i class="notika-icon notika-form"></i> Users</a></li>
                                @endif
                                <li><a href="/logout">Logout</a>
                                </li>
<!--                                <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">App views</a>

                                </li>
                                <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages</a>
                                </li>-->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active"><a href="/akaunti"><i class="notika-icon notika-house"></i> Akaunti</a>
                        </li>
                        <li><a href="/upload/song"><i class="notika-icon notika-app"></i> Pakia Wimbo</a>
                        </li>
                        <li><a href="/akaunti/nyimbo/live"><i class="notika-icon notika-bar-chart"></i> Zipo Kwenye Tovuti</a>
                        </li>
                        <li><a href="/akaunti/nyimbo/pending"><i class="notika-icon notika-edit"></i> Subiri Review</a>
                        </li>
                        <li><a href="/akaunti/watunzi"><i class="notika-icon notika-support"></i> Watunzi</a>
                        </li>
                        @can('kuhakiki')
                            <li><a href="/akaunti/review-nyimbo"><i class="notika-icon notika-form"></i> Hakiki Nyimbo</a>
                            </li>
                        @endcan
                        @can('kutoa ithibati')
                            <li><a href="/akaunti/toa-ithibati"><i class="notika-icon notika-form"></i> Toa Ithibati</a>
                            </li>
                        @endcan
                        @if(auth()->user()->hasAnyRole(['super admin', 'admin']))
                            <li><a href="/users"><i class="notika-icon notika-form"></i> Users</a>
                            </li>
                        @endif
                        <li><a href="/logout"><i class="notika-icon notika-right-arrow"></i> Logout</a>
                        </li>
<!--                        <li><a href="#Appviews"><i class="notika-icon notika-app"></i> App views</a>
                        </li>
                        <li><a href="#Page"><i class="notika-icon notika-support"></i> Pages</a>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->
    <!-- Start Status area -->
    @section('content')
    @show
    <!-- End Status area-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
. All rights reserved. Template by <a href="/">SMN</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
        ============================================ -->
    <script src="/js/backend/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="/js/backend/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="/js/backend/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="/js/backend/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="/js/backend/owl.carousel.min.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="/js/backend/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="/js/backend/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
        ============================================ -->
    <script src="/js/backend/counterup/jquery.counterup.min.js"></script>
    <script src="/js/backend/counterup/waypoints.min.js"></script>
    <script src="/js/backend/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="/js/backend/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- jvectormap JS
        ============================================ -->
    <script src="/js/backend/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/js/backend/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/js/backend/jvectormap/jvectormap-active.js"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="/js/backend/sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/backend/sparkline/sparkline-active.js"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="/js/backend/flot/jquery.flot.js"></script>
    <script src="/js/backend/flot/jquery.flot.resize.js"></script>
    <script src="/js/backend/flot/curvedLines.js"></script>
    <script src="/js/backend/flot/flot-active.js"></script>
    <!-- knob JS
        ============================================ -->
    <script src="/js/backend/knob/jquery.knob.js"></script>
    <script src="/js/backend/knob/jquery.appear.js"></script>
    <script src="/js/backend/knob/knob-active.js"></script>
    <!--  wave JS
        ============================================ -->
    <script src="/js/backend/wave/waves.min.js"></script>
    <script src="/js/backend/wave/wave-active.js"></script>
    <!--  todo JS
        ============================================ -->
    <script src="/js/backend/todo/jquery.todo.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="/js/backend/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="/js/backend/main.js"></script>
    @section('footer')
    @show
</body>

</html>