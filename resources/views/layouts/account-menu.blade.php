<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="/akaunti">
            Akaunti Yangu
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#accountMenu" aria-controls="accountMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="accountMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/upload/song">Pakia wimbo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/akaunti/nyimbo/live">Zipo Kwenye Tovuti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/akaunti/nyimbo/pending">Subiri Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/akaunti/watunzi">Watunzi</a>
                </li>
                @if(auth()->user()->hasRole('uhakiki'))
                    <li class="nav-item">
                        <a class="nav-link" href="/akaunti/review-nyimbo">Review Nyimbo</a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('ithibati'))
                    <li class="nav-item">
                        <a class="nav-link" href="/akaunti/review-nyimbo">Ithibati</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>