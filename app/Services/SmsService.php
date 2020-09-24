<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class SmsService
{
    /**
     * @param $to
     * @param $sms
     * @return \Illuminate\Http\Client\Response
     */
    private function sendSms($to, $sms) {
        $rahisisha_api = config('zesha.api_url');

        // Message parameters
        $param['username'] = config('zesha.username');
        $param['password'] = config('zesha.password');
        $param['GSM'] = "255657867793"; // Recipient number (+ is optional)
        $param['SMSText'] = $sms; // Your SMS message
        $param['sender'] = config('zesha.sender_id');; // Your sender ID

        $response = Http::get($rahisisha_api, $param);

        return $response;
    }

    /**
     * @param User $user
     * @param int $code
     * @return bool
     */
    public function sendActivationCode(User $user, int $code)
    {
        $message = __('messages.verification_code',
            [
                'code' => $code,
            ]
        );

        $this->sendSms($user->phone, $message);

        return true;
    }

}
