<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;

class ServicesController extends Controller
{
    public function index()
    {        
        SEOMeta::setTitle('Huduma zinazotolewa');
        SEOMeta::setDescription('Huduma mbalimbali zinazotolewa SMN');
        
        return view('services.index');
       
    }
}
