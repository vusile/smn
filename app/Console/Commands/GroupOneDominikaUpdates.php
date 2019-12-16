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
            1 => ["dominika_date" => "2020-01-19", "rangi" => "Kijani"], //Dominika ya 2 Mwaka A
            4 => ["dominika_date" => "2020-01-26", "rangi" => "Kijani"], //Dominika ya 3 Mwaka A
            10 => ["dominika_date" => "2020-02-09", "rangi" => "Kijani"], //Dominika ya 5 Mwaka A
            13 => ["dominika_date" => "2020-02-16", "rangi" => "Kijani"], //Dominika ya 6 Mwaka A
            16 => ["dominika_date" => "2020-02-23", "rangi" => "Kijani"], //Dominika ya 7 Mwaka A
//            19 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 8 Mwaka A
//            22 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 9 Mwaka A
//            25 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 10 Mwaka A
//            28 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 11 Mwaka A
            31 => ["dominika_date" => "2020-06-21", "rangi" => "Kijani"], //Dominika ya 12 Mwaka A
            34 => ["dominika_date" => "2020-06-28", "rangi" => "Kijani"], //Dominika ya 13 Mwaka A
            37 => ["dominika_date" => "2020-07-05", "rangi" => "Kijani"], //Dominika ya 14 Mwaka A
            40 => ["dominika_date" => "2020-07-12", "rangi" => "Kijani"], //Dominika ya 15 Mwaka A
            43 => ["dominika_date" => "2020-07-19", "rangi" => "Kijani"], //Dominika ya 16 Mwaka A
            46 => ["dominika_date" => "2020-07-26", "rangi" => "Kijani"], //Dominika ya 17 Mwaka A
            49 => ["dominika_date" => "2020-08-02", "rangi" => "Kijani"], //Dominika ya 18 Mwaka A
            52 => ["dominika_date" => "2020-08-09", "rangi" => "Kijani"], //Dominika ya 19 Mwaka A
            55 => ["dominika_date" => "2020-08-16", "rangi" => "Kijani"], //Dominika ya 20 Mwaka A
            58 => ["dominika_date" => "2020-08-23", "rangi" => "Kijani"], //Dominika ya 21 Mwaka A
            61 => ["dominika_date" => "2020-08-30", "rangi" => "Kijani"], //Dominika ya 22 Mwaka A
            64 => ["dominika_date" => "2020-09-06", "rangi" => "Kijani"], //Dominika ya 23 Mwaka A
            67 => ["dominika_date" => "2020-09-13", "rangi" => "Kijani"], //Dominika ya 24 Mwaka A
            70 => ["dominika_date" => "2020-09-20", "rangi" => "Kijani"], //Dominika ya 25 Mwaka A
            73 => ["dominika_date" => "2020-09-27", "rangi" => "Kijani"], //Dominika ya 26 Mwaka A
            76 => ["dominika_date" => "2020-10-04", "rangi" => "Kijani"], //Dominika ya 27 Mwaka A
            79 => ["dominika_date" => "2020-10-11", "rangi" => "Kijani"], //Dominika ya 28 Mwaka A
            82 => ["dominika_date" => "2020-10-18", "rangi" => "Kijani"], //Dominika ya 29 Mwaka A
            85 => ["dominika_date" => "2020-10-25", "rangi" => "Kijani"], //Dominika ya 30 Mwaka A
//            88 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 31 Mwaka A
            91 => ["dominika_date" => "2020-11-08", "rangi" => "Kijani"], //Dominika ya 32 Mwaka A
            94 => ["dominika_date" => "2020-11-15", "rangi" => "Kijani"], //Dominika ya 33 Mwaka A
            97 => ["dominika_date" => "2020-01-01", "rangi" => "Nyeupe"], //Maria Mtakatifu Mama wa Mungu (1 Januari)
            98 => ["dominika_date" => "2020-01-05", "rangi" => "Nyeupe"], //Epifania
            99 => ["dominika_date" => "2020-01-12", "rangi" => "Nyeupe"], //Ubatizo wa Bwana
            100 => ["dominika_date" => "2020-02-02", "rangi" => "Nyeupe"],//Kutolewa Bwana Hekaluni
            101 => ["dominika_date" => "2020-02-26", "rangi" => "Urujuani"], //Jumatano ya Majivu
            102 => ["dominika_date" => "2020-03-01", "rangi" => "Urujuani"], //Dominika ya 1 ya Kwaresma Mwaka A
            105 => ["dominika_date" => "2020-03-08", "rangi" => "Urujuani"], //Dominika ya 2 ya Kwaresma Mwaka A
            108 => ["dominika_date" => "2020-03-15", "rangi" => "Urujuani"], //Dominika ya 3 ya Kwaresma Mwaka A
            111 => ["dominika_date" => "2020-03-22", "rangi" => "Urujuani"], //Dominika ya 4 ya Kwaresma Mwaka A
            114 => ["dominika_date" => "2020-03-29", "rangi" => "Urujuani"], //Dominika ya 5 ya Kwaresma Mwaka A
            117 => ["dominika_date" => "2020-04-05", "rangi" => "Nyekundu"], //Dominika ya Matawi
            118 => ["dominika_date" => "2020-04-09", "rangi" => "Nyeupe"], //Alhamisi Kuu
            119 => ["dominika_date" => "2020-04-10", "rangi" => "Nyekundu"], //Ijumaa Kuu
            120 => ["dominika_date" => "2020-04-11", "rangi" => "Nyeupe"], //Mkesha wa Pasaka
            121 => ["dominika_date" => "2020-04-12", "rangi" => "Nyeupe"], //Dominika ya Pasaka
            122 => ["dominika_date" => "2020-04-19", "rangi" => "Nyeupe"], //Dominika ya 2 ya Pasaka Mwaka A
            125 => ["dominika_date" => "2020-04-26", "rangi" => "Nyeupe"], //Dominika ya 3 ya Pasaka Mwaka A
            128 => ["dominika_date" => "2020-05-03", "rangi" => "Nyeupe"], //Dominika ya 4 ya Pasaka Mwaka A
            131 => ["dominika_date" => "2020-05-10", "rangi" => "Nyeupe"], //Dominika ya 5 ya Pasaka Mwaka A
            134 => ["dominika_date" => "2020-05-17", "rangi" => "Nyeupe"], //Dominika ya 6 ya Pasaka Mwaka A
//            137 => ["dominika_date" => "NULL", "rangi" => "Nyeupe"], //Dominika ya 7 ya Pasaka Mwaka A
            140 => ["dominika_date" => "2020-05-24", "rangi" => "Nyeupe"], //Kupaa kwa Bwana
            141 => ["dominika_date" => "2020-05-31", "rangi" => "Nyeupe"], //Pentekoste
            142 => ["dominika_date" => "2020-06-07", "rangi" => "Nyeupe"], //Utatu Mtakatifu Mwaka A
            145 => ["dominika_date" => "2020-06-14", "rangi" => "Nyeupe"], //Mwili na Damu Takatifu ya Bwana Wetu Yesu Kristu Mwaka A
            148 => ["dominika_date" => "2020-08-15", "rangi" => "Nyeupe"], //Kupalizwa Mbinguni Bikira Maria
            149 => ["dominika_date" => "2020-11-01", "rangi" => "Nyeupe"], //Watakatifu Wote
            150 => ["dominika_date" => "2020-11-02", "rangi" => "Urujuani"], //Marehemu Wote
            160 => ["dominika_date" => "2019-12-22", "rangi" => "Urujuani"], // Mwaka A", //Dominika ya 4 ya Majilio
            164 => ["dominika_date" => "2019-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Mkesha)
            165 => ["dominika_date" => "2019-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Usiku)
            166 => ["dominika_date" => "2019-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Alfajiri)
            167 => ["dominika_date" => "2019-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Mchana)
            168 => ["dominika_date" => "2019-12-29", "rangi" => "Nyeupe"], //Familia Takatifu
            172 => ["dominika_date" => "2020-12-08", "rangi" => "Nyeupe"], //Sherehe ya Bikira Maria mkingiwa dhambi ya asili
            173 => ["dominika_date" => "2020-03-19", "rangi" => "Nyeupe"], //Yosefu Mume wa Bikira Maria
            174 => ["dominika_date" => "2020-03-25", "rangi" => "Nyeupe"], //Kupashwa habari ya kuzaliwa kwa Bwana
        ];
        
        foreach($old as $id => $updates) {
            Dominika::where('id', $id)
                    ->update($updates);
        }

    $new = 
        [
            [
                'title' => 'Moyo Mtakatifu wa Yesu',
                'year_id' => null,
                'dominika_date' => '2020-06-19',
                'rangi' => 'Nyeupe'
            ],
        ];
    
        foreach($new as $dominika) {
            Dominika::create($dominika);
        }
    }
}
