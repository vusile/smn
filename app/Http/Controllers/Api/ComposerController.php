<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\ComposerCollection;
use App\Http\Resources\Collections\SongCollection;
use App\Http\Resources\Composer as ComposerResource;
use App\Models\Composer;
use App\Services\ComposerService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComposerController extends Controller
{
    protected $composerService;
    
    public function __construct(ComposerService $composerService) 
    {
        $this->composerService = $composerService;
    }
    
    public function index()
    {   
        $composers = Composer::all()
            ->sortBy('name')
            ->filter(
                function ($composer) {
                    return ($composer->active_songs > 0) && $composer->name;
                }
            );       
        
        return new ComposerCollection($composers);
    }
    
    public function show(Composer $composer)
    {
        return new ComposerResource($composer);
    }
    
    public function songs(Composer $composer)
    {  
        return new SongCollection(
            $composer->songs->where('status', 1)
        );
    }
    
    public function create()
    {
        return view(
            'composers.create'
        );
    }
    
    public function edit(Composer $composer)
    {
        return view(
            'composers.edit',
            compact('composer')
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
    
    public function update(Request $request)
    {
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

        Composer::where('id', $request->input('composer_id'))
            ->update(
                array_replace(
                    $request->except(['uploader_is_composer', '_token', 'composer_id']),
                    $additionalInfo
                )
            );

       
        return redirect()->route(
            'account.composers'
        );
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
    
    public function account()
    {   
        $composers = Composer::where('user_id', auth()->user()->id)
            ->orderBy('name')
            ->whereNotNull('name')
            ->paginate(20);       
        
        return view(
            'account.composers',
            compact('composers')
        );
    }
}
