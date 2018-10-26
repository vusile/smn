<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Services\ComposerService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ComposerController extends Controller
{
    protected $composerService;
    
    public function __construct(ComposerService $composerService) 
    {
        $this->composerService = $composerService;
    }
    
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
                    return $composer->has_active_songs && $composer->name;
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
    
    public function create()
    {
        return view(
            'composers.create'
        );
    }
    
    public function store(Request $request)
    {
        $duplicates = $this->composerService
                ->checkForDuplicates($request->input('name'));
        
        if (!$duplicates) {
            $customMessages = [
                'name.required' => 'Jina la mtunzi ni lazima',
            ];
        
            $this->validate(
                $request,
                [
                    'name' => 'required',
                ],
                $customMessages
            );

            $additionalInfo = $this->uploadComposerPhotos($request);
        
            if ($request->has('uploader_is_composer')) {
            $additionalInfo['user_id'] = auth()->user()->id;
        }
        
            $composer = Composer::create(
                array_replace(
                    $request->all(),
                    $additionalInfo
                )
            );

            if (request('return_to_song_upload')) {
                return redirect()->route(
                    'song-upload.index',
                    [
                        'selected_composer' => $composer->id
                    ]
                );
            } else {
                return redirect()->route(
                    'account.composers'
                );
            }
        } else {
            return view(
                'composers.create',
                compact('duplicates')
            );
        }
    }
    
    protected function uploadComposerPhotos($request)
    {        
        $photos = [];
        for ($i = 1; $i < 4; $i++) {
            $photoField = "photo$i";
            if ($request->file($photoField)) {
                $path = $request->file($photoField)
                    ->store(
                        config('composer.files.paths.images'),
                        'composers'
                    );
                $photos[$photoField] = getFileNameFromPath($path);
            }
        }
       
        return $photos;
    }
}
