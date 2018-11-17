@extends('layouts.front-end')
@section('content')
@include('layouts.account-menu')
<div class="container">
    <div class="row">
        
        <div class="col-lg-8" >
            <br />
            <h3>Karibu kwenye akaunti yako:</h3>
            <br />
            <p><strong>Jumla ya nyimbo ulizo - upload:</strong> {{number_format($pendingSongs + $activeSongs)}}</p>
            <p><strong>Jumla ya nyimbo zilizo live:</strong> {{number_format($activeSongs)}} ambazo zimetamwa mara {{number_format($views)}}, na kupakuliwa mara {{number_format($downloads)}}</p>
            <p><strong>Jumla ya nyimbo zilizo pending:</strong> {{number_format($pendingSongs)}}</p>
            <p><strong>Mpaka sasa umesaidia SMN kureview nyimbo:</strong> {{number_format($songsReviewed)}}</p>
        </div>
        <div class="col-lg-2"></div>
      
    </div>
</div>
@stop