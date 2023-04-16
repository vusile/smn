<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use libphonenumber\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;

class SmsService
{
    /**
     * @param User $user
     * @param string $template
     * @param array $bodyValues
     * @param array $buttonValues
     * @return Response | false
     */
    public function sendSms(User $user, string $template, array $bodyValues = [], array $buttonValues = []) {

        if(!$user->has_whatsapp) {
            return false;
        }

        $madePhone = PhoneNumber::make($user->phone);

        try {
            if(!$madePhone->getCountry()) {
                return false;
            }
        } catch (NumberParseException $e) {
            return false;
        }

        $phone = $madePhone->formatE164();

        $templateInfo = [
            'name' => $template,
            'language' => [
                'code' => 'sw'
            ]
        ];

        $components = [];
        if($bodyValues) {
            $parameters = [];
            foreach($bodyValues as $type => $value) {
                $component = [
                    'type' => 'text',
                    'text' => $value
                ];

                $parameters[] = $component;
            }

            $components[] = [
                'type' => 'body',
                'parameters' => $parameters
            ];
        }

        if($buttonValues) {
            $parameters = [];
            foreach($bodyValues as $type => $value) {
                $component = [
                    'type' => $type,
                    'text' => $value
                ];

                $parameters[] = $component;
            }

            $components[] = [
                'type' => 'button',
                'sub_type' => 'url',
                'index' => 0,
                'parameters' => $parameters
            ];
        }

        if(count($components)) {
            $templateInfo['components'] = $components;
        }

        $response = Http::withToken(config('whatsapp.whatsapp_token'))
            ->asJson()
            ->post(config('whatsapp.api_url'),
                [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $phone,
                    'type' => 'template',
                    'template' => json_encode($templateInfo),
                ]
            );

        return $response;
    }

    /**
     * @param User $user
     * @param int $code
     * @return Response | false
     */
    public function sendActivationCode(User $user, int $code)
    {
        return $this->sendSms($user, 'auth_code', ['text' => $code]);
    }

    public function sendOptions()
    {
         $interactive = [
            "type" => "list",
            "header" => [
                "type" => "text",
                "text" => "Maswali ya Mara kwa Mara",
            ],
            "body" => [
                "text" => "Karibu tukusaidie. Ni jambo gani ambalo ungependa kupata msaada:"
            ],
            "footer" => [
                "text" => "Kutoka kwa bot wa SMN"
            ],
            "action" => [
                "button" => "Chagua kati ya yafuatayo",
                "sections" => [
                    "title" => "",
                    "rows" => [
                        [
                            "id" => 1,
                            "title" => "Nahitaji kujua namna ya kupaika nyimbo"
                        ],
                        [
                            "id" => 2,
                            "title" => "Mbona wimbo wangu umechelewa kuingia kwenye mtandao"
                        ],
                        [
                            "id" => 3,
                            "title" => "Natengneza vipi akaunti"
                        ],
                    ]
                ]
            ],
        ];

        $response = Http::withToken(config('whatsapp.whatsapp_token'))
            ->asJson()
            ->post(config('whatsapp.api_url'),
                [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    "type" => "interactive",
                    "to" => "255657867793",
                    "interactive" => json_encode($interactive)
                ]
            );
    }

}
