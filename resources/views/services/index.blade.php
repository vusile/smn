@extends('layouts.front-end')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Huduma mbalimbali zinazotolewa SMN</h1>
    <!--<p class="lead">{{ $description }}.</p>-->
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Huduma ya Kuchorewa (Kuandikiwa) nyimbo kwa kutumia software</h2>
                    <p class="card-text">Karibu kwa ajili ya huduma hii ya kuchorewa nyimbo kwa kutumia software. Kama nilivyowatangazia mwaka jana, rafiki na mwalimu mwenzangu Prosper Msaki anasaidiana nami katika jukumu hili. Wengi mlipendekeza kuwe na kiwango fixed</p>
                    <p><a class="btn btn-secondary" href="/blog/{{ $blogPost->url }}/{{ $blogPost->id }}" role="button">Soma Zaidi</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop