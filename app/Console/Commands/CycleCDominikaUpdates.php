<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dominika;

class CycleCDominikaUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dominika:dates-for-cycle-c';

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
     */
    public function handle()
    {
        $old = [
            3 => ["dominika_date" => "2022-01-16", "rangi" => "Kijani"], //Dominika ya 2 Mwaka C
            6 => ["dominika_date" => "2022-01-23", "rangi" => "Kijani"], //Dominika ya 3 Mwaka C
            9 => ["dominika_date" => "2022-01-30", "rangi" => "Kijani"], //Dominika ya 4 Mwaka C
            12 => ["dominika_date" => "2022-02-06", "rangi" => "Kijani"], //Dominika ya 5 Mwaka C
            15 => ["dominika_date" => "2022-02-13", "rangi" => "Kijani"], //Dominika ya 6 Mwaka C
            18 => ["dominika_date" => "2022-02-20", "rangi" => "Kijani"], //Dominika ya 7 Mwaka C
            21 => ["dominika_date" => "2022-02-27", "rangi" => "Kijani"], //Dominika ya 8 Mwaka C
//            24 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 9 Mwaka C
//            27 => ["dominika_date" => "NULL", "rangi" => "Kijani"], //Dominika ya 10 Mwaka C
//            30 => ["dominika_date" => "2022-06-", "rangi" => "Kijani"], //Dominika ya 11 Mwaka C
//            33 => ["dominika_date" => "2022-06-", "rangi" => "Kijani"], //Dominika ya 12 Mwaka C
            36 => ["dominika_date" => "2022-06-26", "rangi" => "Kijani"], //Dominika ya 13 Mwaka C
            39 => ["dominika_date" => "2022-07-03", "rangi" => "Kijani"], //Dominika ya 14 Mwaka C
            42 => ["dominika_date" => "2022-07-10", "rangi" => "Kijani"], //Dominika ya 15 Mwaka C
            45 => ["dominika_date" => "2022-07-17", "rangi" => "Kijani"], //Dominika ya 16 Mwaka C
            48 => ["dominika_date" => "2022-07-24", "rangi" => "Kijani"], //Dominika ya 17 Mwaka C
            51 => ["dominika_date" => "2022-07-31", "rangi" => "Kijani"], //Dominika ya 18 Mwaka C
            54 => ["dominika_date" => "2022-08-07", "rangi" => "Kijani"], //Dominika ya 19 Mwaka C
            57 => ["dominika_date" => "2022-08-14", "rangi" => "Kijani"], //Dominika ya 20 Mwaka C
            60 => ["dominika_date" => "2022-08-21", "rangi" => "Kijani"], //Dominika ya 21 Mwaka C
            63 => ["dominika_date" => "2022-08-28", "rangi" => "Kijani"], //Dominika ya 22 Mwaka C
            66 => ["dominika_date" => "2022-09-04", "rangi" => "Kijani"], //Dominika ya 23 Mwaka C
            69 => ["dominika_date" => "2022-09-11", "rangi" => "Kijani"], //Dominika ya 24 Mwaka C
            72 => ["dominika_date" => "2022-09-18", "rangi" => "Kijani"], //Dominika ya 25 Mwaka C
            75 => ["dominika_date" => "2022-09-25", "rangi" => "Kijani"], //Dominika ya 26 Mwaka C
            78 => ["dominika_date" => "2022-10-02", "rangi" => "Kijani"], //Dominika ya 27 Mwaka C
            81 => ["dominika_date" => "2022-10-09", "rangi" => "Kijani"], //Dominika ya 28 Mwaka C
            84 => ["dominika_date" => "2022-10-16", "rangi" => "Kijani"], //Dominika ya 29 Mwaka C
            87 => ["dominika_date" => "2022-10-23", "rangi" => "Kijani"], //Dominika ya 30 Mwaka C
            90 => ["dominika_date" => "2022-10-30", "rangi" => "Kijani"], //Dominika ya 31 Mwaka C
            93 => ["dominika_date" => "2022-11-06", "rangi" => "Kijani"], //Dominika ya 32 Mwaka C
            96 => ["dominika_date" => "2022-11-13", "rangi" => "Kijani"], //Dominika ya 33 Mwaka C
            97 => ["dominika_date" => "2022-01-01", "rangi" => "Nyeupe"], //Maria Mtakatifu Mama wa Mungu (1 Januari)
            98 => ["dominika_date" => "2022-01-02", "rangi" => "Nyeupe"], //Epifania
            99 => ["dominika_date" => "2022-01-09", "rangi" => "Nyeupe"], //Ubatizo wa Bwana
            100 => ["dominika_date" => "2022-02-02", "rangi" => "Nyeupe"],//Kutolewa Bwana Hekaluni
            101 => ["dominika_date" => "2022-03-02", "rangi" => "Urujuani"], //Jumatano ya Majivu
            104 => ["dominika_date" => "2022-03-06", "rangi" => "Urujuani"], //Dominika ya 1 ya Kwaresma Mwaka C
            107 => ["dominika_date" => "2022-03-13", "rangi" => "Urujuani"], //Dominika ya 2 ya Kwaresma Mwaka C
            110 => ["dominika_date" => "2022-03-20", "rangi" => "Urujuani"], //Dominika ya 3 ya Kwaresma Mwaka C
            113 => ["dominika_date" => "2022-03-27", "rangi" => "Urujuani"], //Dominika ya 4 ya Kwaresma Mwaka C
            116 => ["dominika_date" => "2022-04-03", "rangi" => "Urujuani"], //Dominika ya 5 ya Kwaresma Mwaka C
            117 => ["dominika_date" => "2022-04-10", "rangi" => "Nyekundu"], //Dominika ya Matawi
            118 => ["dominika_date" => "2022-04-14", "rangi" => "Nyeupe"], //Alhamisi Kuu
            119 => ["dominika_date" => "2022-04-15", "rangi" => "Nyekundu"], //Ijumaa Kuu
            120 => ["dominika_date" => "2022-04-16", "rangi" => "Nyeupe"], //Mkesha wa Pasaka
            121 => ["dominika_date" => "2022-04-17", "rangi" => "Nyeupe"], //Dominika ya Pasaka
            124 => ["dominika_date" => "2022-04-24", "rangi" => "Nyeupe"], //Dominika ya 2 ya Pasaka Mwaka C
            127 => ["dominika_date" => "2022-05-01", "rangi" => "Nyeupe"], //Dominika ya 3 ya Pasaka Mwaka C
            130 => ["dominika_date" => "2022-05-08", "rangi" => "Nyeupe"], //Dominika ya 4 ya Pasaka Mwaka C
            133 => ["dominika_date" => "2022-05-15", "rangi" => "Nyeupe"], //Dominika ya 5 ya Pasaka Mwaka C
            136 => ["dominika_date" => "2022-05-22", "rangi" => "Nyeupe"], //Dominika ya 6 ya Pasaka Mwaka C
            139 => ["dominika_date" => "2022-05-29", "rangi" => "Nyeupe"], //Dominika ya 7 ya Pasaka Mwaka C
            140 => ["dominika_date" => "2022-05-26", "rangi" => "Nyeupe"], //Kupaa kwa Bwana
            141 => ["dominika_date" => "2022-06-05", "rangi" => "Nyeupe"], //Pentekoste
            144 => ["dominika_date" => "2022-06-12", "rangi" => "Nyeupe"], //Utatu Mtakatifu Mwaka C
            147 => ["dominika_date" => "2022-06-19", "rangi" => "Nyeupe"], //Mwili na Damu Takatifu ya Bwana Wetu Yesu Kristu Mwaka C
            148 => ["dominika_date" => "2022-08-15", "rangi" => "Nyeupe"], //Kupalizwa Mbinguni Bikira Maria
            149 => ["dominika_date" => "2022-11-01", "rangi" => "Nyeupe"], //Watakatifu Wote
            150 => ["dominika_date" => "2022-11-02", "rangi" => "Urujuani"], //Marehemu Wote
            153 => ["dominika_date" => "2022-11-20", "rangi" => "Nyeupe"], //Kristu Mfalme
            175 => ["dominika_date" => "2022-06-24", "rangi" => "Nyeupe"], //Moyo Mtakatifu wa Yesu
            169 => ["dominika_date" => "2022-11-27", "rangi" => "Urujuani"], // Mwaka A", //Dominika ya 1 ya Majilio
            154 => ["dominika_date" => "2022-12-04", "rangi" => "Urujuani"], // Mwaka A", //Dominika ya 2 ya Majilio
            157 => ["dominika_date" => "2022-12-11", "rangi" => "Urujuani"], // Mwaka A", //Dominika ya 3 ya Majilio
            160 => ["dominika_date" => "2022-12-18", "rangi" => "Urujuani"], // Mwaka A", //Dominika ya 4 ya Majilio
            164 => ["dominika_date" => "2022-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Mkesha)
            165 => ["dominika_date" => "2022-12-24", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Usiku)
            166 => ["dominika_date" => "2022-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Alfajiri)
            167 => ["dominika_date" => "2022-12-25", "rangi" => "Nyeupe"], //Kuzaliwa kwa Bwana (Misa ya Mchana)
            168 => ["dominika_date" => "2022-12-30", "rangi" => "Nyeupe"], //Familia Takatifu
            172 => ["dominika_date" => "2022-12-08", "rangi" => "Nyeupe"], //Sherehe ya Bikira Maria mkingiwa dhambi ya asili
            173 => ["dominika_date" => "2022-03-19", "rangi" => "Nyeupe"], //Yosefu Mume wa Bikira Maria
            174 => ["dominika_date" => "2022-03-25", "rangi" => "Nyeupe"], //Kupashwa habari ya kuzaliwa kwa Bwana
        ];

        foreach($old as $id => $updates) {
            Dominika::where('id', $id)
                    ->update($updates);
        }
    }
}
