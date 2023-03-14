<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WhatsappTracker;
use App\Services\SmsService;
use Illuminate\Http\Request;

class WhatsAppMessagesController extends Controller
{
    public function index()
    {
        $whatsappMessages = WhatsappTracker::all();
//            ->sortByDesc('id');

        return view(
            'account.whatsapp-messages',
            compact(
                'whatsappMessages'
            )
        );
    }

    public function create()
    {
        $templates = [
            'hello' => "Hello",
            'tumsifu' => "Tumsifu Yesu Kristu",
            'tumwimbie_bwana' => "Tumwimbie Bwana",
            'hello_world' => 'sample_issue_resolution',
        ];

        return view(
            'whatsapp.create',
            compact(
                'templates'
            )
        );
    }

    public function send(Request $request) {

        $user = User::firstOrCreate(
            [
                'phone' => $request->get('phone'),
                'has_whatsapp' => true,
            ]
        );

        $smsService = new SmsService();
        $smsService->sendSms($user, $request->get('template_name'));

        return redirect()->back()->with('message', "Ujumbe umetumwa");
    }
}
