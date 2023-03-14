<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

if (! function_exists('songLink')) {
    function songLink($song, $newPage = false) {
        $target = "";
        if($newPage)
        {
            $target = "target='_blank'";
        }
        return "<a $target href = '" . url('/') . "/wimbo/" . $song->url . "/". $song->id . "'>" . $song->name . "</a>";
    }
}

if (!function_exists('getFileNameFromPath')) {
    function getFileNameFromPath(string $path)
    {
        return last(
            explode('/', $path)
        );
    }
}

if (!function_exists('downloadLink')) {
    function downloadLink($song, string $type)
    {
        return  url('/') . '/song/download/' . $song->id . '/' . $type . '/' . $song->$type;
    }
}

if (!function_exists('whatsappBold')) {
    function whatsappBold(string $text)
    {
        return  '*'.$text.'*';
    }
}

if (!function_exists('cleanUpAnswer')) {
    function cleanUpAnswer(string $answer): string
    {
        return Str::upper(str_replace(" ", '', $answer));
    }
}

if (!function_exists('timeSent')) {
    function timeSent(string $date): string
    {
        return Carbon::parse($date)->format('d F Y');
    }
}
