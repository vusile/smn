<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dominika;

class CycleBDominikaUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dominika:dates-for-cycle-b';

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
//            2 => ["dominika_date" => "2021-01-19", "rangi" => "Kijani"], //Dominika ya 2 Mwaka B
//            5 => ["dominika_date" => "2021-01-26", "rangi" => "Kijani"], //Dominika ya 3 Mwaka B
//            8 => ["dominika_date" => "2021-01-26", "rangi" => "Kijani"], //Dominika ya 4 Mwaka B
//            11 => ["dominika_date" => "2021-02-09", "rangi" => "Kijani"], //Dominika ya 5 Mwaka B
//            14 => ["dominika_date" => "2021-02-16", "rangi" => "Kijani"], //Dominika ya 6 Mwaka B
//            17 => ["dominika_date" => "2021-02-23", "rangi" => "Kijani"], //Dominika ya 7 Mwaka B
//            20 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 8 Mwaka B
//            23 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 9 Mwaka B
//            26 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 10 Mwaka B
            29 => ["dominika_date" => "2021-06-13", "rangi" => "Kijani"], //Dominika ya 11 Mwaka B
            32 => ["dominika_date" => "2021-06-20", "rangi" => "Kijani"], //Dominika ya 12 Mwaka B
            35 => ["dominika_date" => "2021-06-27", "rangi" => "Kijani"], //Dominika ya 13 Mwaka B
            38 => ["dominika_date" => "2021-07-04", "rangi" => "Kijani"], //Dominika ya 14 Mwaka B
            41 => ["dominika_date" => "2021-07-11", "rangi" => "Kijani"], //Dominika ya 15 Mwaka B
            44 => ["dominika_date" => "2021-07-18", "rangi" => "Kijani"], //Dominika ya 16 Mwaka B
            47 => ["dominika_date" => "2021-07-25", "rangi" => "Kijani"], //Dominika ya 17 Mwaka B
            50 => ["dominika_date" => "2021-08-01", "rangi" => "Kijani"], //Dominika ya 18 Mwaka B
            53 => ["dominika_date" => "2021-08-08", "rangi" => "Kijani"], //Dominika ya 19 Mwaka B
            //56 => ["dominika_date" => "2021-08-16", "rangi" => "Kijani"], //Dominika ya 20 Mwaka B
            59 => ["dominika_date" => "2021-08-22", "rangi" => "Kijani"], //Dominika ya 21 Mwaka B
            62 => ["dominika_date" => "2021-08-29", "rangi" => "Kijani"], //Dominika ya 22 Mwaka B
            65 => ["dominika_date" => "2021-09-05", "rangi" => "Kijani"], //Dominika ya 23 Mwaka B
            68 => ["dominika_date" => "2021-09-12", "rangi" => "Kijani"], //Dominika ya 24 Mwaka B
            71 => ["dominika_date" => "2021-09-19", "rangi" => "Kijani"], //Dominika ya 25 Mwaka B
            74 => ["dominika_date" => "2021-09-26", "rangi" => "Kijani"], //Dominika ya 26 Mwaka B
            77 => ["dominika_date" => "2021-10-03", "rangi" => "Kijani"], //Dominika ya 27 Mwaka B
            80 => ["dominika_date" => "2021-10-10", "rangi" => "Kijani"], //Dominika ya 28 Mwaka B
            83 => ["dominika_date" => "2021-10-17", "rangi" => "Kijani"], //Dominika ya 29 Mwaka B
            86 => ["dominika_date" => "2021-10-24", "rangi" => "Kijani"], //Dominika ya 30 Mwaka B
            89 => ["dominika_date" => "2021-10-31", "rangi" => "Kijani"], //Dominika ya 31 Mwaka B
            92 => ["dominika_date" => "2021-11-07", "rangi" => "Kijani"], //Dominika ya 32 Mwaka B
            95 => ["dominika_date" => "2021-11-14", "rangi" => "Kijani"], //Dominika ya 33 Mwaka B
//            97 => ["dominika_date" => "2022-01-01", "rangi" => "Nyeupe"], //Maria Mtakatifu Mama wa Mungu (1 Januari)
//            98 => ["dominika_date" => "2021-01-05", "rangi" => "Nyeupe"], //Epifania
//            99 => ["dominika_date" => "2021-01-12", "rangi" => "Nyeupe"], //Ubatizo wa Bwana
//            100 => ["dominika_date" => "2021-02-02", "rangi" => "Nyeupe"],//Kutolewa Bwana Hekaluni
            101 => ["dominika_date" => "2021-02-17", "rangi" => "Urujuani"], //Jumatano ya Majivu
            103 => ["dominika_date" => "2021-02-21", "rangi" => "Urujuani"], //Dominika ya 1 ya Kwaresma Mwaka B
            106 => ["dominika_date" => "2021-02-28", "rangi" => "Urujuani"], //Dominika ya 2 ya Kwaresma Mwaka B
            109 => ["dominika_date" => "2021-03-07", "rangi" => "Urujuani"], //Dominika ya 3 ya Kwaresma Mwaka B
            112 => ["dominika_date" => "2021-03-14", "rangi" => "Urujuani"], //Dominika ya 4 ya Kwaresma Mwaka B
            115 => ["dominika_date" => "2021-03-21", "rangi" => "Urujuani"], //Dominika ya 5 ya Kwaresma Mwaka B
            117 => ["dominika_date" => "2021-03-28", "rangi" => "Nyekundu"], //Dominika ya Matawi
            118 => ["dominika_date" => "2021-04-01", "rangi" => "Nyeupe"], //Alhamisi Kuu
            119 => ["dominika_date" => "2021-04-02", "rangi" => "Nyekundu"], //Ijumaa Kuu
            120 => ["dominika_date" => "2021-04-03", "rangi" => "Nyeupe"], //Mkesha wa Pasaka
            121 => ["dominika_date" => "2021-04-04", "rangi" => "Nyeupe"], //Dominika ya Pasaka
            123 => ["dominika_date" => "2021-04-11", "rangi" => "Nyeupe"], //Dominika ya 2 ya Pasaka Mwaka B
            126 => ["dominika_date" => "2021-04-18", "rangi" => "Nyeupe"], //Dominika ya 3 ya Pasaka Mwaka B
            129 => ["dominika_date" => "2021-04-25", "rangi" => "Nyeupe"], //Dominika ya 4 ya Pasaka Mwaka B
            132 => ["dominika_date" => "2021-05-02", "rangi" => "Nyeupe"], //Dominika ya 5 ya Pasaka Mwaka B
            135 => ["dominika_date" => "2021-05-09", "rangi" => "Nyeupe"], //Dominika ya 6 ya Pasaka Mwaka B
            138 => ["dominika_date" => "2021-05-16", "rangi" => "Nyeupe"], //Dominika ya 7 ya Pasaka Mwaka B
            140 => ["dominika_date" => "2021-05-13", "rangi" => "Nyeupe"], //Kupaa kwa Bwana
            141 => ["dominika_date" => "2021-05-23", "rangi" => "Nyeupe"], //Pentekoste
            143 => ["dominika_date" => "2021-05-30", "rangi" => "Nyeupe"], //Utatu Mtakatifu Mwaka B
            146 => ["dominika_date" => "2021-06-06", "rangi" => "Nyeupe"], //Mwili na Damu Takatifu ya Bwana Wetu Yesu Kristu Mwaka B
            148 => ["dominika_date" => "2021-08-15", "rangi" => "Nyeupe"], //Kupalizwa Mbinguni Bikira Maria
            149 => ["dominika_date" => "2021-11-01", "rangi" => "Nyeupe"], //Watakatifu Wote
            150 => ["dominika_date" => "2021-11-02", "rangi" => "Urujuani"], //Marehemu Wote
            152 => ["dominika_date" => "2021-11-21", "rangi" => "Nyeupe"], //Kristu Mfalme
            175 => ["dominika_date" => "2021-06-11", "rangi" => "Nyeupe"], //Moyo Mtakatifu wa Yesu
            170 => ["dominika_date" => "2021-11-28", "rangi" => "Urujuani"], // Mwaka B", //Dominika ya 1 ya Majilio
            155 => ["dominika_date" => "2021-12-05", "rangi" => "Urujuani"], // Mwaka B", //Dominika ya 2 ya Majilio
            158 => ["dominika_date" => "2021-12-12", "rangi" => "Urujuani"], // Mwaka B", //Dominika ya 3 ya Majilio
            161 => ["dominika_date" => "2021-12-19", "rangi" => "Urujuani"], // Mwaka B", //Dominika ya 4 ya Majilio
            164 => ["dominika_date" => "2021-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Mkesha)
            165 => ["dominika_date" => "2021-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Usiku)
            166 => ["dominika_date" => "2021-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Alfajiri)
            167 => ["dominika_date" => "2021-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Mchana)
            168 => ["dominika_date" => "2019-12-26", "rangi" => "Nyeupe"], //Familia Takatifu
            172 => ["dominika_date" => "2021-12-08", "rangi" => "Nyeupe"], //Sherehe ya Bikira Maria mkingiwa dhambi ya asili
            173 => ["dominika_date" => "2021-03-19", "rangi" => "Nyeupe"], //Yosefu Mume wa Bikira Maria
            174 => ["dominika_date" => "2021-03-25", "rangi" => "Nyeupe"], //Kupashwa habari ya kuzaliwa kwa Bwana
        ];

        foreach($old as $id => $updates) {
            Dominika::where('id', $id)
                    ->update($updates);
        }
    }
}
