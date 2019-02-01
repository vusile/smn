<!doctype html>
<html lang="en">
  <head>
    @if(env('APP_ENV') == 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-18823668-4"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-18823668-4');
        </script>
    @endif

    @if(env('APP_ENV') != 'production')
        <meta name="robots" content="noindex,nofollow">
    @endif
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! SEOMeta::generate() !!}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/custom.css" crossorigin="anonymous">
    
    @section('header')
    @show
    
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><img scr="/images/swahili-music-notes-logo-site.png" /></h5>
     
        <div class="container">
           
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <a class="navbar-brand" href="/">
                    <img src="/images/swahili-music-notes-logo-site.png" alt="Swahili Music Notes">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Nyumbani</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/makundi-nyimbo">Makundi Nyimbo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/watunzi">Watunzi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dominika-sikukuu">Nyimbo za Dominika</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/wapakia-nyimbo">Wapakia Nyimbo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/about-us/1">Kuhusu SMN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/">Taarifa</a>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>
      
      
      @if (Auth::check())
        <a class="btn btn-outline-primary" href="/akaunti">Akaunti</a>
        &nbsp;<a class="btn btn-outline-primary" href="/logout">Logout</a>
      @else
        <a class="btn btn-outline-primary" href="{{ route('login') }}">Ingia / Jisajili</a>
      @endif
    </div>
    <div class="container">
        <form class="form-inline"  method="get" action="/search" novalidate>
            <div class="form-group mx-sm-10 mb-2 col-lg-11">
              <input style ="width:100%" type="text" class="form-control" id="st" name="st" placeholder="Tafuta wimbo" value="{{request()->query('st')}}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tafuta</button>
        </form>
        @if (session('msg', null))
            <div class="alert alert-success" role="alert">
                {{session('msg', null)}}
            </div>
        @endif
    </div>
    @section('content')
    @show
    <footer class="blog-footer">
      <!--<p>&nbsp</p>-->
      <p>Mawasiliano <a href="/contact">Bofya hapa</a></p>
      <p>&copy {{date('Y')}}</p>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    @section('footer')
    @show
  </body>
</html>