<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WebHookController extends Controller
{
    public function verify() {
        if(
            request()->query('hub_mode') == 'subscribe'
            && request()->query('hub_verify_token') == config('whatsapp.verify_token')
        ) {
            echo request()->query('hub_challenge');
//            return response()->json(
//                [
//                    request()->query('hub_challenge'),
//                ],
//            )->setStatusCode(
//                ResponseAlias::HTTP_OK,
//                Response::$statusTexts[ResponseAlias::HTTP_OK]
//            );
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
