<?php

namespace App\Http\Controllers;

use App\Events\SongCreated;
use App\Models\Category;
use App\Models\Composer;
use App\Models\Dominika;
use App\Models\Song;
use App\Services\SearchService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SongUploadController extends Controller
{
    /*
     * @var SongService
     */
    protected $songService;
    
    /*
     * @var SearchService
     */
    protected $searchService;
    
    public function __construct(
        SongService $songService,
        SearchService $searchService
    ) {
        $this->songService = $songService;
        $this->searchService = $searchService;
    }
    
    public function index()
    {
        $composers = Composer::all()
            ->sortBy('name')
            ->filter(
                function ($composer) {
                    return $composer->name;
                }
            )
            ->pluck('name', 'id')
            ->toArray();
        
        return view(
            'songs.upload.index',
            compact('composers')
        );
    }
    
    public function details(Request $request)
    {
        $customMessages = [
            'name.required' => 'Jina la wimbo ni lazima',
            'composer_id.required' => 'Jina la mtunzi ni lazima',
        ];
        
        $this->validate(
            $request,
            [
                'name' => 'required',
                'composer_id' => 'required',
            ],
            $customMessages
        );
        
        $composer = Composer::find(
            $request->input('composer_id')
        );
        
        $songName = $request->input('name'); 
        $categories = Category::orderBy('title')
                ->get();
        
        $softwares = DB::table('softwares')
                ->get()
                ->pluck('software_name', 'id')
                ->toArray();
        
        $duplicates = $this->searchService
            ->search(
                $songName . ' ' . $composer->name,
                'songs'
            );
       
        return view(
            'songs.upload.details',
            compact(
                'composer',
                'songName',
                'categories',
                'duplicates',
                'softwares'
            )      
        );
    }
    
    public function store(Request $request)
    {
        $customMessages = [
            'name.required' => 'Jina la wimbo ni lazima',
            'composer_id.required' => 'Jina la mtunzi ni lazima',
            'pdf.required'  => 'PDF ni lazima',
            'pdf.mimes'  => 'Tafadhali upload file la PDF',
            'midi.mimes'  => 'Tafadhali upload file la Midi, MP3',
            'categories.required'  => 'Walau kundi nyimbo moja ni lazima',
        ];
        
        $this->validate(
            $request,
            [
                'name' => 'required',
                'composer_id' => 'required',
                'pdf' => 'required|mimes:pdf',
                'software_file' => 'required_with:allowed_to_edit',
                'midi' => 'mimes:mid,ogx,aac,wav,mpga',
                'categories' => 'required',
                'software_file.required_with'  => 'Tafadhali pakia file ulilosave na software ili iweze kubadilishwa ikihitajika',
            ],
            $customMessages
        );

        $pdfName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->pdf->getClientOriginalName()));
        $pdfPath = $request->file('pdf')->storeAs('uploads/files', $pdfName);
        
//        $pdfName = getFileNameFromPath($pdfPath);
        
        if ($request->file('midi')) {
            $midiName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->midi->getClientOriginalName()));
            $midiPath = $request->file('midi')->storeAs('uploads/files', $midiName);
            
        }
        
        if ($request->file('software_file')) {          
            $softwareFileName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->software_file->getClientOriginalName()));
            
            $softwareFilePath = $request->file('software_file')->storeAs('uploads/files', $softwareFileName); 
        }
        
        if ($request->file('nota_original')) {
            $originalFilePath = $request->file('nota_original')->store('uploads/files');
            
            $originalFileName = getFileNameFromPath($originalFilePath); 
        }
        
        $additionalInfo = [
            'user_id' => auth()->user()->id,
            'pdf' => $pdfName,
            'midi' => isset($midiName) ? $midiName : null,
            'nota_original' => isset($originalFileName) ? $originalFileName : null,
            'software_file' => isset($softwareFileName) ? $softwareFileName : null,
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 4
        ];
        
        $song = Song::create(
            array_replace(
                $request->all(),
                $additionalInfo
            )
        );
        
        $song->categories()
            ->sync($request->input('categories'));
        
        event(new SongCreated($song));

        return redirect()->route(
            'song-upload.dominika',
            [
                'song' => $song
            ]
        );
    }
    
    public function update(Request $request)
    {
        $songId = $request->input('song_id');
        
        $song = Song::find($songId);
        $customMessages = [
            'name.required' => 'Jina la wimbo ni lazima',
            'composer_id.required' => 'Jina la mtunzi ni lazima',
            'pdf.mimes'  => 'Tafadhali upload file la PDF',
            'midi.mimes'  => 'Tafadhali upload file la Midi, MP3',
            'categories.required'  => 'Walau kundi nyimbo moja ni lazima',
//            'software_file.required_with'  => 'Tafadhali pakia file ulilosave na software ili iweze kubadilishwa ikihitajika',
        ];
        
        $this->validate(
            $request,
            [
                'name' => 'required',
                'composer_id' => 'required',
                'pdf' => 'mimes:pdf',
                'midi' => 'mimes:mid,ogx,aac,wav,mpga',
                'categories' => 'required',
//                'software_file' => 'required_with:allowed_to_edit',
            ],
            $customMessages
        );
        
        $additionalInfo = [];
        $revisions = [];
        
        if ($request->file('pdf')){
           
            $pdfName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->pdf->getClientOriginalName()));
            $pdfPath = $request->file('pdf')->storeAs('uploads/files', $pdfName);
            
            $additionalInfo['pdf'] = $pdfName;
            
            if($song->status == 9) {
                $song->status = 6;
                $song->ithibati_notification_sent_date = null;
                $song->save();
            }
            if($song->status == 5) {
                
                DB::table('reviews')
                    ->where('song_id', $song->id)
                    ->delete();
                
                $song->status = 4;
                $song->save();
            }    
        }
        
        if ($request->file('midi')) {
            $midiName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->midi->getClientOriginalName()));
            $midiPath = $request->file('midi')->storeAs('uploads/files', $midiName);
            
            $additionalInfo['midi'] = $midiName;
        }
        
        if ($request->file('software_file')) {
            $softwareFileName = Carbon::now()->timestamp . '-' . str_slug($request->input('name')) . '.' . last(explode('.', $request->software_file->getClientOriginalName()));
            
            $softwareFilePath = $request->file('software_file')->storeAs('uploads/files', $softwareFileName);
             
            $additionalInfo['software_file'] = $softwareFileName;
        }
        
        if ($request->file('nota_original')) {
            $originalFilePath = $request->file('nota_original')->store('uploads/files');
            
            $originalFileName = getFileNameFromPath($originalFilePath); 
            $additionalInfo['nota_original'] = $originalFileName;
        }
       
        
        $categoriesBeforeChange = $song->categories()->pluck('title', 'url')->toArray();
       
//        Song::where('id', $songId)
//            ->update(
//                array_replace(
//                    $request->except(['categories', '_token', 'song_id', 'return']),
//                    $additionalInfo
//                )
//            );
        
        $song->name = $request->name;
        $song->composer_id = $request->composer_id;
        $song->lyrics = $request->lyrics;
        $song->software_id = $request->software_id;
        if ($request->file('pdf')) {
            $song->pdf = $additionalInfo['pdf'];
        }
        if ($request->file('midi')) {
            $song->midi = $additionalInfo['midi'];
        }
        if ($request->file('software_file')) {
            $song->software_file = $additionalInfo['software_file'];
        }
        if ($request->file('nota_original')) {
            $song->nota_original = $additionalInfo['nota_original'];
        }
        
        $song->categories()
            ->sync($request->input('categories'));
        
        if($request->get('fit_for_liturgy')) {
           $song->fit_for_liturgy = true;
        } else {
           $song->fit_for_liturgy = false;            
        }
        
        if($request->get('for_recording')) {
           $song->for_recording = true;
        } else {
           $song->for_recording = false;            
        }
        
        $song->save();
        
        $song->refresh();
        $categoriesAfterChange = $song->categories()->pluck('title', 'url')->toArray();
               
        $this->saveChanges($categoriesBeforeChange, $categoriesAfterChange, $song);
        
        if($request->get('return')) {
            return redirect()->route(
                'song-review.index'
            );
        }
        
        return redirect()->route(
            'song-upload.dominika',
            [
                'song' => $song
            ]
        );
    }
   
    
    public function dominika(Song $song)
    {
        $dominikas = Dominika::all()
            ->pluck('title', 'id')
            ->toArray();
        
        $parts = collect($this->songService->determinePartOfMass($song));
        
        $songHasDominikas = false;
              
        if (!$parts) {
            $parts = $this->songService->similarSongsWithDominika($song->name);
        } else {
            $songHasDominikas = true;
        }
        
        return view(
            'songs.upload.dominikas',
            compact(
                'song',
                'dominikas',
                'parts',
                'songHasDominikas'
            )      
        );
    }
    
    public function storeDominika(Request $request)
    {
        $song = Song::find($request->input('song_id'));
       
        $mwanzo = $this->partsOfMass($song, $request->input('mwanzo'), 1);
        $katikati = $this->partsOfMass($song, $request->input('katikati'), 2);
        $shangilio = $this->partsOfMass($song, $request->input('shangilio'), 3);
        $antifona = $this->partsOfMass($song, $request->input('antifona'), 4); 
        
        $song->dominikas()->sync(
                array_merge(
                    array_merge($mwanzo,  $katikati),
                    array_merge($shangilio + $antifona)
                ) 
            );
        
        return redirect()->route(
            'song-upload.preview',
            [
                'song' => $song
            ]
        );
    }
    
    public function deleteDominika(Request $request)
    {
        $song = Song::find($request->input('song_id'));
 
        DB::table('dominikas_songs')
                ->where('song_id', $request->input('song_id'))
                ->delete();

        return redirect()->route(
            'song-upload.preview',
            [
                'song' => $song
            ]
        );
    }
    
    public function preview(Song $song)
    {
        $parts = null;
        
        if($song->dominikas) {
            $parts = $this->songService->determinePartOfMass($song);
        }
        
        return view(
            'songs.upload.preview',
            compact(
                'song',
                'parts'
            )      
        );
    }
    
    protected function partsOfMass(
        Song $song,
        array $dominikaIds = null,
        int $partOfMassId
    ) {
        if ($dominikaIds) {            
            return collect($dominikaIds)
                ->map(function ($mwanzo) use ($partOfMassId) {
                    return [
                        'dominika_id' => $mwanzo,
                        'parts_of_mass_id' => $partOfMassId
                    ];
                })
                ->toArray();
        }
        
        return [];
    }
    
    public function edit(Song $song)
    {
        $composers = Composer::all()
            ->sortBy('name')
            ->filter(
                function ($composer) {
                    return $composer->name;
                }
            )
            ->pluck('name', 'id')
            ->toArray();
            
        $selectedCategories = $song->categories
            ->pluck('id')
            ->toArray();
        
        
        $categories = Category::orderBy('title')
            ->get();
        
        $softwares = DB::table('softwares')
                ->get()
                ->pluck('software_name', 'id')
                ->toArray();
        
        return view(
            'songs.upload.edit',
            compact(
                'song',
                'categories',
                'composers',
                'softwares',
                'selectedCategories'
            )      
        );
    }
    
    private function saveChanges($categoriesBeforeChange, $categoriesAfterChange, $song)
    {
        $categoriesChanges = array_diff($categoriesBeforeChange, $categoriesAfterChange);
        $revisions = [];
        
        if(count($categoriesChanges) || count($categoriesAfterChange) != count($categoriesBeforeChange)) {
            $revisions[] = array(
                'revisionable_type' => 'App\Models\Song',
                'revisionable_id' => $song->id,
                'key' => 'categories',
                'old_value' => implode(", ", $categoriesBeforeChange),
                'new_value' => implode(", ", $categoriesAfterChange),
                'user_id' => auth()->user()->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            );
        }
      
        if(count($revisions)) {
            DB::table('revisions')
                ->insert($revisions);
        }            
        
        return true;
    }
}