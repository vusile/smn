<?php

namespace App\Http\Controllers;

use App\Events\SongCreated;
use App\Models\Category;
use App\Models\Composer;
use App\Models\Dominika;
use App\Models\Song;
use App\Services\IthibatiService;
use App\Services\SearchService;
use App\Services\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
                'software_file' => 'required_with:software_id',
                'midi' => 'mimes:mid,ogx,aac,wav,mpga,mpeg',
                'categories' => 'required',
            ],
            $customMessages
        );

        $pdfName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->pdf->getClientOriginalName()));
        $pdfPath = $request->file('pdf')->storeAs('uploads/files', $pdfName);

        if ($request->file('midi')) {
            $midiName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->midi->getClientOriginalName()));
            $midiPath = $request->file('midi')->storeAs('uploads/files', $midiName);

            if(str_contains($midiName, 'mpga')){
                $midiName = head(explode('.', $midiName)) . '.mp3';
                Storage::move(
                    $midiPath,
                    'uploads/files/' . $midiName
                );
            }
        }

        if ($request->file('software_file')) {
            $softwareFileName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->software_file->getClientOriginalName()));
            $softwareFilePath = $request->file('software_file')->storeAs('uploads/files', $softwareFileName);
        }

        if ($request->file('nota_original')) {
            $originalFilePath = $request->file('nota_original')->store('uploads/files');

            $originalFileName = getFileNameFromPath($originalFilePath);
        }

        $additionalInfo = [
            'user_id' => auth()->user()->id,
            'pdf' => $pdfName,
            'midi' => $midiName ?? null,
            'nota_original' => $originalFileName ?? null,
            'software_file' => $softwareFileName ?? null,
            'uploaded_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 4,
            'name'=> Str::title($request->input('name'))
        ];

        $song = Song::create(
            array_replace
            (
                $request->except(['composer_alive']),
                $additionalInfo
            )
        );

        $song->categories()
            ->sync($request->input('categories'));

        event(new SongCreated($song));

        $this->composerLifeStatus(
            $request->input('composer_alive'),
            $request->input('composer_id')
        );

        return redirect()->route(
            'song-upload.dominika',
            [
                'song' => $song
            ]
        );
    }

    private function composerLifeStatus($isAlive, $composerId)
    {
        if (!$isAlive) {
           $isAlive = 'sijui';
        }

        if($isAlive != 'sijui') {
            DB::table('composers_life_status')
                ->insert(
                    [
                        'user_id' => auth()->user()->id,
                        'composer_id' => $composerId,
                        'alive' => $isAlive
                    ]
                );
        }

        $lifeStatusCheck = DB::table('composers_life_status')
            ->where(['composer_id' => $composerId])
            ->get();

        if($lifeStatusCheck->count() >= 10) {
            $yes = $lifeStatusCheck->filter(function ($lifeStatus) {
                return $lifeStatus->alive == 'yes';
            });

            $no = $lifeStatusCheck->filter(function ($lifeStatus) {
                return $lifeStatus->alive == 'no';
            });

            $statusConfirmed = false;
            if($yes->count() > $no->count()) {
                $statusConfirmed = true;
                $composerIsAlive = 1;
            } elseif ($yes->count() < $no->count()) {
                $statusConfirmed = true;
                $composerIsAlive = 2;
            }

            if($statusConfirmed) {
                Composer::where('id', $composerId)
                    ->update(['composer_alive' => $composerIsAlive]);

                DB::table('composers_life_status')
                    ->where(['composer_id' => $composerId])
                    ->delete();
            }
        }
    }

    public function update(Request $request)
    {
        $customMessages = [
            'name.required' => 'Jina la wimbo ni lazima',
            'composer_id.required' => 'Jina la mtunzi ni lazima',
            'pdf.mimes'  => 'Tafadhali upload file la PDF',
            'midi.mimes'  => 'Tafadhali upload file la Midi, MP3',
            'categories.required'  => 'Walau kundi nyimbo moja ni lazima',
        ];

        $this->validate(
            $request,
            [
                'name' => 'required',
                'composer_id' => 'required',
                'pdf' => 'mimes:pdf',
                'midi' => 'mimes:mid,ogx,aac,wav,mpga,mpeg',
                'categories' => 'required',
            ],
            $customMessages
        );

        $song = Song::find($request->input('song_id'));
        $additionalInfo = [];

        if ($request->file('pdf')){
            $pdfName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->pdf->getClientOriginalName()));
            $pdfPath = $request->file('pdf')->storeAs('uploads/files', $pdfName);

            $additionalInfo['pdf'] = $pdfName;

            if ($song->ithibati_number) {
               $ithibatiService = new IthibatiService();
               $ithibatiService->printIthibatiNumberOnPdf($song);
            }
        }

        if ($request->file('midi')) {
            $midiName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->midi->getClientOriginalName()));
            $midiPath = $request->file('midi')->storeAs('uploads/files', $midiName);

            if(str_contains($midiName, 'mpga')){
                $midiName = head(explode('.', $midiName)) . '.mp3';
                Storage::move(
                    $midiPath,
                    'uploads/files/' . $midiName
                );
            }

            $additionalInfo['midi'] = $midiName;
        }

        if ($request->file('software_file')) {
            $softwareFileName = Carbon::now()->timestamp . '-' . Str::slug($request->input('name')) . '.' . last(explode('.', $request->software_file->getClientOriginalName()));

            $softwareFilePath = $request->file('software_file')->storeAs('uploads/files', $softwareFileName);
        }

        if ($request->file('nota_original')) {
            $originalFilePath = $request->file('nota_original')->store('uploads/files');

            $originalFileName = getFileNameFromPath($originalFilePath);
            $additionalInfo['nota_original'] = $originalFileName;
        }

        $additionalInfo['name'] = Str::title($request->input('name'));

        $song->update(
            array_replace(
                $request->except(['categories', '_token', 'song_id', 'composer_alive']),
                $additionalInfo
            )
        );


        $this->composerLifeStatus(
            $request->input('composer_alive'),
            $request->input('composer_id')
        );

        $song->categories()
            ->sync($request->input('categories'));

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

//        $parts = $this->songService->similarSongsWithDominika($song->name);

        return view(
            'songs.upload.dominikas',
            compact(
                'song',
                'dominikas'
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

        $songStatuses = DB::table('song_statuses')
            ->get()
            ->pluck('title', 'id')
            ->toArray();

        return view(
            'songs.upload.edit',
            compact(
                'song',
                'categories',
                'composers',
                'softwares',
                'selectedCategories',
                'songStatuses'
            )
        );
    }

    public function deleteReason(Song $song) {
        return view(
            'songs.delete.reason',
            compact(
                'song'
            )
        );
    }

    public function delete(Request $request, Song $song) {

        if(!$request->input('delete_reason')) {
            return redirect()->back()->with('error', 'Ni lazima uweke sababu ya kufuta wimbo');
        }

        $song->status = config('song.statuses.deleted');
        $song->delete_reason = $request->input('delete_reason');
        $song->save();

        return redirect('akaunti')
            ->with(
                'message',
                'Umefanikiwa kufuta wimbo ' . $song->name
            );
    }
}
