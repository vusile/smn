<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dominika;

class GroupOneDominikaUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dominika:group-one-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $old = [
//            3 => "2019-01-20",
//            6 => "2019-01-27",
//            9 => "2019-02-03",
//            12 => "2019-02-10",
//            15 => "2019-02-17",
//            18 => "2019-02-24",
//            21 => "2019-03-03",
//            36 => "2019-06-30",
//            39 => "2019-07-07",
//            42 => "2019-07-14",
//            45 => "2019-07-21",
//            48 => "2019-07-28",
//            51 => "2019-08-04",
//            54 => "2019-08-11",
//            57 => "2019-08-18",
//            60 => "2019-08-25",
//            63 => "2019-09-01",
//            66 => "2019-09-08",
//            69 => "2019-09-15",
//            72 => "2019-09-22",
//            75 => "2019-09-29",
//            78 => "2019-10-06",
//            81 => "2019-10-13",
//            84 => "2019-10-20",
//            87 => "2019-10-27",
//            90 => "2019-11-03",
//            93 => "2019-11-10",
//            96 => "2019-11-17",
//            104 => "2019-03-10",
//            107 => "2019-03-17",
//            110 => "2019-03-24",
//            113 => "2019-03-31",
//            116 => "2019-04-07",
//            124 => "2019-04-28",
//            127 => "2019-05-05",
//            130 => "2019-05-12",
//            133 => "2019-05-19",
//            136 => "2019-05-26",
//            144 => "2019-06-16",
//            147 => "2019-06-23",
//            153 => "2019-11-24",
//            156 => "2018-12-09",
//            159 => "2018-12-16",
//            162 => "2018-12-23",
//            117 => "2019-04-14",
//            164 => "2018-12-24",
//            165 => "2018-12-24",
//            166 => "2018-12-25",
//            167 => "2018-12-25",
//            168 => "2018-12-30",
//            97 => "2019-01-01",
//            98 => "2019-01-06",
//            99 => "2019-01-13",
//            101 => "2019-03-06",
//            118 => "2019-04-18",
//            119 => "2019-04-19",
//            120 => "2019-04-20",
//            121 => "2019-04-21",
//            139 => "2019-06-02",
//            140 => "2019-05-30",
//            141 => "2019-06-09",
//            148 => "2019-08-15",
            149 => "2019-11-01",
            150 => "2019-11-02",
//            100 => "2019-02-02",
        ];
        
    foreach($old as $id => $date) {
        Dominika::where('id', $id)
                ->update(['dominika_date' => $date]);
    }

//    $new = 
//        [
//            [
//                'title' => 'Sherehe ya Bikira Maria mkingiwa dhambi ya asili',
//                'year_id' => null,
//                'dominika_date' => '2018-12-08',
//            ],
//            [
//                'title' => 'Yosefu Mume wa Bikira Maria',
//                'year_id' => null,
//                'dominika_date' => '2019-03-19',
//            ],
//            [
//                'title' => 'Kupashwa habari ya kuzaliwa kwa Bwana',
//                'year_id' => null,
//                'dominika_date' => '2019-03-25',
//            ],
//
//        ];
    
//        foreach($new as $dominika) {
//            Dominika::create($dominika);
//        }
    }
}
