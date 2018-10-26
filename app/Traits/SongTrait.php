<?php

namespace App\Traits;

trait SongTrait
{
    public function getHasSongsAttribute()
    {
        return $this->songs->count();
    }
    
    public function getHasActiveSongsAttribute()
    {
        return $this->activeSongs()->count();
    }

    public function scopeActiveSongs()
    {
        return $this->songs
                ->filter(function ($song) {
                    return $song->is_active;
                });
    }
}

