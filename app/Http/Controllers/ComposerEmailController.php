<?php

namespace App\Http\Controllers;

use App\Composer;
use App\ComposerEmail;
use App\Events\ComposerEmailCreated;
use Illuminate\Http\Request;

class ComposerEmailController extends Controller
{
    public function store(Request $request)
    {
        if (
                $request->input('composer_id') 
                && !$request->input('maoni')
        ) {            
            $this->validate($request, [
                'sender_name' => 'required',
                'sender_email' => 'required',
                'sender_phone' => 'required',
                'message' => 'required',
                'composer_id' => 'required',
            ]);
           

            $composerEmail = ComposerEmail::create($request->all());
            
            event(new ComposerEmailCreated($composerEmail));

            $composer = Composer::find($request->input('composer_id'));

            return redirect('/composer/profile/' . $composer->url . '/' . $composer->id )
                    ->with('message', 'Ujumbe wako umetumwa!');
        }
        
        return back();
    }
}
