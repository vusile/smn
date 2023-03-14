<div class="row  {{$loop->index%2 == 0 ? "nk-white" : "" }} ">
    <div class="col-lg-3" >
        <p>
            {{$whatsappMessage->phone}}
            <br />
{{--            Show time to 24 hours since message was sent--}}
            <br />{{ timeSent($whatsappMessage->created_at) }}
             @if($whatsappMessage->type != 'status')
                <br /><a href = '/admin/users/change-password-request/id'>Reply</a>
            @endif
        </p>
    </div>

    <div class="col-lg-3" >
        <p>{{$whatsappMessage->type}}</p>
    </div>
    <div class="col-lg-3" >
        <p>{{$whatsappMessage->delivery_status}}</p>
    </div>
    <div class="col-lg-3" >
        <p>{{$whatsappMessage->message}}</p>
    </div>
</div>
