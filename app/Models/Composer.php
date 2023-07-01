<?php

namespace App\Models;

use App\Traits\SongTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Composer extends Model
{
    use CrudTrait;
    use Sluggable;
    use SongTrait;

    public $timestamps = false;

    protected $fillable = ['name', 'details', 'email', 'phone', 'url', 'photo1', 'photo2', 'photo3', 'jimbo', 'parokia', 'user_id', 'mimi_ndio_huyu_mtunzi', 'added_by'];

    public function sluggable(): array
    {
        return [
            'url' => [
                'source' => 'name'
            ]
        ];
    }

    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }

    public function getHasProfileAttribute()
    {
        return $this->details || $this->has_photo || $this->phone;
    }

    public function getHasPhotoAttribute()
    {
        return $this->photo2 || $this->photo1 || $this->photo3;
    }

    public function helpers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'helpable', 'helpers', 'helpable_id', 'helper_id');
    }
}
