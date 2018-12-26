<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\ComposerEmail;
use App\Events\ComposerEmailCreated;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\Request;

class ComposerEmailController extends Controller
{
    public function store(Request $request)
    {
        if (
            $request->input('composer_id') 
            && !$request->input('maoni')
        ) {      
            $customMessages = [
                'g-recaptcha-response.required' => 'Tafadhali jaribu tena!'
            ];
            
            $this->validate(
                    $request,
                    [
                        'sender_name' => 'required',
                        'sender_email' => 'required',
                        'sender_phone' => 'required',
                        'message' => 'required',
                        'composer_id' => 'required',
                        'g-recaptcha-response' => ['required', new ValidRecaptcha]
                    ],
                    $customMessages
                );
           
            $data = $request->all();
            $composerEmail = ComposerEmail::create($data);
            
            event(new ComposerEmailCreated($composerEmail, $data));

            $composer = Composer::find($request->input('composer_id'));

            return redirect('/watunzi/wasifu-mawasiliano/' . $composer->url . '/' . $composer->id )
                    ->with('message', 'Ujumbe wako umetumwa!');
        }
        
        return back();
    }
}
