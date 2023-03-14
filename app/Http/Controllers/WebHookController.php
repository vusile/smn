<?php

namespace App\Http\Controllers;

use App\Models\WhatsappTracker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WebHookController extends Controller
{
    public function verify() {
        if(
            request()->query('hub_mode') == 'subscribe'
            && request()->query('hub_verify_token') == config('whatsapp.verify_token')
        ) {
            echo request()->query('hub_challenge');
            return ;
        }

        return response()->json(
            [],
        )->setStatusCode(
            ResponseAlias::HTTP_BAD_REQUEST,
            Response::$statusTexts[ResponseAlias::HTTP_BAD_REQUEST]
        );
    }

    public function event(Request $request) {
        $this->determineType(
            Arr::dot(
                json_decode(
                    $request->get('body') , true
                )
            )
        );
    }

    public function determineType($array) {
        Log::debug('lets determine type.');
        Log::debug('lets determine type.' . json_encode($array));
        $newArray = [];
        $isMessage = false;
        $isStatus = false;
        foreach($array as $key => $value) {
            if(Str::contains($key, ['messages'])) {
                $isMessage = true;
                $newArray[array_reverse(explode(".", $key))[0]] = $value;
            }

            if(Str::contains($key, ['statuses'])) {
                $isStatus = true;
                if(Str::contains($key, ['conversation', 'id'])) {
                    $key = str_replace('conversation.id', 'conversation_id', $key);
                }
                $newArray[array_reverse(explode(".", $key))[0]] = $value;
            }
        }

        if($isMessage) {
            WhatsappTracker::create(
                [
                    'type' => 'message',
                    'phone' => $newArray['from'],
                    'message_id' => $newArray['id'],
                    'message' => $newArray['body']
                ]
            );
        }

        if($isStatus) {
            WhatsappTracker::updateOrCreate(
                [
                    'message_id' => $newArray['id']
                ],
                [
                    'type' => 'status',
                    'phone' => $newArray['recipient_id'],
                    'message_id' => $newArray['id'],
                    'conversation_id' => $newArray['conversation_id'],
                    'delivery_status' => $newArray['status']
                ]
            );
        }
    }
}
