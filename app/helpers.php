<?php

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
