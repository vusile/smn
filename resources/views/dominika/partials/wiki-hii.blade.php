@foreach($ibadaZaWikiHii as $ibada)
    <p>
        {{ $ibada->dominika_date->format('d-m-Y') }} :
        <a href = "/dominika-sikukuu/{{Str::slug($ibada->title)}}/{{$ibada->id}}">{{$ibada->title }} - {{$ibada->rangi }}  (Tazama Nyimbo)</a>
    </p>
@endforeach
