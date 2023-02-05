<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WebHookController extends Controller
{
    public function verify() {

        dd(config('whatsapp.verify_token'));
        if(
            request()->query('hub.mode') == 'subscribe'
            && request()->query('hub.verify_token') == config('whatsapp.verify_token')
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
        )->setStatusCode(
            ResponseAlias::HTTP_BAD_REQUEST,
            Response::$statusTexts[ResponseAlias::HTTP_BAD_REQUEST]
        );
    }

    public function event() {

    }
}
