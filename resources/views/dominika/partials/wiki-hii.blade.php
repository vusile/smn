@foreach($ibadaZaWikiHii as $ibada)
    <p>
        {{ $ibada->dominika_date->format('d-m-Y') }} :  
        <a href = "/dominika-sikukuu/ratiba/{{str_slug($ibada->title)}}/{{$ibada->id}}">{{$ibada->title }} (Tazama Nyimbo)</a>
    </p>
@endforeach