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
