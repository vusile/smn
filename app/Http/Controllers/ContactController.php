<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Mail\SiteContact;
use App\Rules\ValidRecaptcha;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * Description of ContactController
 *
 * @author Vusile
 */
class ContactController 
{
    public function index()
    {
        SEOMeta::setTitle('Wasiliana na SMN');
        SEOMeta::setDescription('Wasiliana na SMN');
        
        return view(
            'contact.index'
        );
    }
    
    public function sendEMail(Request $request)
    {

        if (
            !$request->input('maoni')
        ) {
            $customMessages = [
                'g-recaptcha-response.required' => 'Tafadhali jaribu tena!'
            ];
            $this->validate(
                $request,
                [
                    'g-recaptcha-response' => ['required', new ValidRecaptcha]
                ],
                $customMessages
            );
            $data = $request->all();
            Mail::to('admin@swahilimusicnotes.com')
                ->queue(new SiteContact($data));
            
            Session::flash('msg', "Ujumbe wako umetumwa! Tutakujibu karibuni");
        }
        
        return back();
    }
}
