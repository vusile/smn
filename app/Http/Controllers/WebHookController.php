<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WhatsappTracker;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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
                $request->get('entry')
            )
        );
    }

    public function determineType($array) {
        $newArray = [];
        $isMessage = false;
        $isStatus = false;
        $isOther = false;
        foreach($array as $key => $value) {
            if(Str::contains($key, ['messages'])) {
                $isMessage = true;
                $newArray[array_reverse(explode(".", $key))[0]] = $value;
            }

            if(Str::contains($key, ['statuses'])) {
                $isStatus = true;
                if(Str::contains($key, ['conversation.id'])) {
                    $key = str_replace('conversation.id', 'conversation_id', $key);
                }
                $newArray[array_reverse(explode(".", $key))[0]] = $value;
            }

//            if(!$isMessage && !$isStatus) {
//                $isOther=true;
//                $newArray[array_reverse(explode(".", $key))[0]] = $value;
//            }
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

            if(trim($newArray['from']) == "255657867793") {
                $smsService = new SmsService();
                $smsService->sendOptions();
            }
        }

//        if($isOther) {
//            WhatsappTracker::create(
//                [
//                    'type' => 'message',
//                    'phone' => $newArray['from'],
//                    'message_id' => $newArray['id'],
//                    'message' => implode(" ", $newArray)
//                ]
//            );
//        }

        if($isStatus) {
            WhatsappTracker::updateOrCreate(
                [
                    'message_id' => $newArray['id']
                ],
                [
                    'type' => 'status',
                    'phone' => $newArray['recipient_id'],
                    'message_id' => $newArray['id'],
                    'conversation_id' => isset($newArray['conversation_id']) ? $newArray['conversation_id'] : null ,
                    'delivery_status' => $newArray['status']
                ]
            );
        }
    }
}
