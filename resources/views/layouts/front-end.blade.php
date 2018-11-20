<!doctype html>
<html lang="en">
  <head>
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
                                   <div class="col-md-3 mx-auto input-append newsLatterBox text-center">
                                <!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#f2f2f2; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//swahilimusicnotes.us4.list-manage.com/subscribe/post?u=aa71f10f03e79334eecae9324&amp;id=f1359f6fa2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<!-- <h2></h2> -->
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
	<label for="mce-FNAME">Jina la Kwanza (Moja Tu) </label>
	<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
</div>
<div class="mc-field-group">
	<label for="mce-LNAME">Jina la Ukoo (Moja Tu) </label>
	<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_aa71f10f03e79334eecae9324_f1359f6fa2" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->                           </div>
<!--      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>-->
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