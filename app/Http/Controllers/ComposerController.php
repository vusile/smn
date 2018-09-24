<?php

namespace App\Http\Controllers;

use App\Composer;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ComposerController extends Controller
{
    public function index()
    {
        $title = "Watunzi Nyimbo za Kanisa";
        $description = "Wafahamu watunzi mbalimbali wa nyimbo za Kanisa";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        $composers = Composer::all()
            ->sortBy('name')
            ->filter(
                function ($composer) {
                    return $composer->has_songs && $composer->name;
                }
            );       
              
        return view(
            'composers.index',
            compact('composers', 'title', 'description')
        );
    }
    
    public function show(string $url, Composer $composer)
    {
        $kutoka = '';
        if($composer->jimbo)
            $kutoka .= "Jimbo la " . $composer->jimbo . ' ';
        if($composer->parokia)
            $kutoka .= "Parokia ya " . $composer->parokia;
        
        if($kutoka)
            $kutoka= 'Kutoka ' . $kutoka;
        
        $description = "Mfahamu " . $composer->name . ", mtunzi wa nyimbo za Kanisa Katoliki. " . $kutoka;
            
              
        SEOMeta::setTitle($composer->name);
        SEOMeta::setDescription(
            $description
        );
        
        return view(
            'composers.show',
            compact('composer', 'description')
        );
    }
    
    public function songs(string $url, Composer $composer)
    {
        SEOMeta::setTitle("Nyimbo za " . $composer->name);
        SEOMeta::setDescription("Mkusanyiko wa nyimbo za " . $composer->name);
        
        $approvedSongs = $composer->songs->where('status', 1);
        
        return view(
            'composers.songs',
            compact('composer', 'approvedSongs')
        );
    }
}
