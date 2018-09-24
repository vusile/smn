<ul class="pagination text-center">
    @foreach(range('A', 'Z') as $char) 
        <li class="page-item"><a class="page-link" href="#{{$char}}">{{$char}}</a></li>
    @endforeach
</ul>
    