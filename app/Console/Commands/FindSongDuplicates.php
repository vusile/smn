<?php

namespace App\Console\Commands;

use App\Models\Song;
use App\Services\SearchService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class FindSongDuplicates extends Command
{
    /**
     * @var SearchService 
     */
    protected $searchService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'song:find-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find duplicate songs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        dd($this->searchService->search("Alelluia -e Poi Gabriel D. Ng'honoli"));
        $output = new ConsoleOutput();
        Song::orderBy('name')
            ->chunk(10, function($songs) use ($output) {
                $duplicates = $songs->each(function ($song) use ($output){
//                    $song->duplicates_checked = true;
//                    $song->save();
                    
                })
                ->filter(function ($song) use ($output) {
                    return $song->name;
                })
                ->mapWithKeys(function ($song) use ($output){
                    $search = addslashes($song->name . ' ' . $song->composer->name);
                    $output->writeln($search . ' - ' . $song->id);
                    return [
                        'entity_type' => 'song',
                        'entity_id' => $song->id,
                        'duplicates' => $this->searchService
                            ->search($search, 'songs')
                            ->sortByDesc('active_songs')
                            ->pluck('id')
                            ->implode(',')
                    ];
                })
                ->toArray();
               
                $count = count(explode(',', array_get($duplicates, 'duplicates')));
                if($count > 1) {
                    DB::table('duplicates')
                        ->insert($duplicates);
                }

            });
//        $duplicates = Song::where('duplicates_checked', false)
//            ->orderBy('name')    
//            ->take(200)
//            ->get()
//            ->each(function ($song){
//                $song->duplicates_checked = true;
//                $song->save();
//            })    
//            ->filter(function ($song) {
//                $search = $song->name . ' ' . $song->composer->name;
//                $sr = $this->searchService->search($search);
//                if (!is_array($sr)){
//                    $sr = $sr->toArray();
//                }
//                return (count($sr) > 1) && $song->name;
//            })
//            ->mapWithKeys(function ($song){
//                $search = $song->name . ' ' . $song->composer->name;
//                return [
//                    'entity_type' => 'song',
//                    'entity_id' => $song->id,
//                    'duplicates' => $this->searchService
//                        ->search($search)
//                        ->sortByDesc('active_songs')
//                        ->pluck('id')
//                        ->implode(',')
//                ];
//            })
//            ->toArray();
//            
//            DB::table('duplicates')
//                ->insert($duplicates);
    }
}
