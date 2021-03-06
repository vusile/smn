<?php

namespace App\Console\Commands;

use App\Models\Composer;
use App\Services\ComposerService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class FindComposerDuplicates extends Command
{
    /**
     * @var ComposerService
     */
    protected $composerService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'composer:find-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find duplicate composers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ComposerService $composerService)
    {
        $this->composerService = $composerService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $output = new ConsoleOutput();
        Composer::orderBy('name')
//            ->whereIn('id', [2105,2106])
            ->chunk(10, function($composers) use ($output) {
                $duplicates = $composers->each(function ($composer) use ($output) {
                    $composer->duplicates_checked = true;
                    $composer->name = trim(title_case($composer->name));
                    $composer->save();
                })
                ->filter(function ($composer) use ($output) {
                    return strlen($composer->name) > 0;
                })
                ->mapWithKeys(function ($composer) use ($output) {
                    $output->writeln($composer->name . ' - ' . $composer->id);
                    $dupes = $this->composerService
                            ->checkForDuplicates($composer->name, false);

                    if(is_array($dupes) or is_bool($dupes)) {
                        $dupes = collect($composer);
                    }
                    return [$composer->id => [
                        'entity_type' => 'composer',
                        'entity_id' => $composer->id,
                        'duplicates' => $dupes->sortByDesc('active_songs')
                            ->pluck('id')
                            ->implode(',')
                    ]];
                })
                ->each(function ($possibleDuplicate){
                    $count = count(
                        explode(
                                ',',
                                Arr::get($possibleDuplicate, 'duplicates')
                            )
                        );

                    if($count > 1) {
                        DB::table('duplicates')
                            ->insert($possibleDuplicate);
                    }
                });
            });
    }
}
