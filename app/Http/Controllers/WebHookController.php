<?php

namespace App\Http\Controllers;

class WebHookController extends Controller
{
    public function verify() {
        if(
            request()->query('hub.mode') == 'subscribe'
            && request()->query('hub.verify_token') == config('verify_token')
        ) {
            return response()->json(
                [
                    request()->query('hub.challenge'),
                ],
                http_response_code(200)
            );
        }

        return response()->json(
            [],
            http_response_code(200)
        );
    }

    public function event() {

    }
}
