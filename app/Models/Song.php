<?php

namespace App\Models;

use App\Models\SongDownload;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Venturecraft\Revisionable\Revisionable;
use Venturecraft\Revisionable\RevisionableTrait;

class Song extends Model
{
    use Sluggable;
    use RevisionableTrait;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'composer_id',
        'pdf',
        'midi',
        'lyrics',
        'user_id',
        'status',
        'url',
        'software_id',
        'software_file',
        'nota_original',
        'approved_date',
        'approved_by',
        'downloads',
        'views',
        'uploaded_date',
        'allowed_to_edit',
        'fit_for_liturgy',
        'for_recording',
        'ithibati_number',
        'priority_review',
    ];

    public static $showChangesForFields = [
        'categories' => 'Kundi Nyimbo',
        'name' => 'Jina la Wimbo',
        'composer_id' => 'Mtunzi',
        'lyrics' => 'Maneno ya wimbo',
        'fit_for_liturgy' => 'Inafaa kwenye liturjia',
    ];

    protected $keepRevisionOf = ['name', 'categories', 'composer_id', 'lyrics', 'fit_for_liturgy'];

    protected $revisionFormattedFields = [
        'fit_for_liturgy'     => 'boolean:Hapana|Ndio',
    ];

    protected $revisionFormattedFieldNames  = [
        'categories' => 'Kundi Nyimbo',
        'name' => 'Jina la Wimbo',
        'composer_id' => 'Mtunzi',
        'lyrics' => 'Maneno ya wimbo',
        'fit_for_liturgy' => 'Inafaa kwenye liturjia',
    ];

    public function sluggable()
    {
        return [
            'url' => [
                'source' => 'name'
            ]
        ];
    }

    public function composer()
    {
        return $this->belongsTo('App\Models\Composer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'song_categories');
    }

    public function dominikas()
    {
        return $this->belongsToMany('App\Models\Dominika', 'dominikas_songs');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function songDownloads()
    {
        return $this->hasMany('App\Models\SongDownload');
    }

    public function getActualDownloadsAttribute()
    {
        return number_format(
            $this->songDownloads->sum(function ($songDownload) {
                return $songDownload->downloads;
            })
        );
    }

    public function getDescriptionAttribute()
    {
        return $this->lyrics ?? 'Wimbo huu wa ' . $this->name . ' umetungwa na ' . $this->composer->name;
    }

    public function songViews()
    {
        return $this->hasMany('App\SongView');
    }

    public function getActualViewsAttribute()
    {
        return number_format(
            $this->songViews->sum(function ($songView) {
                return $songView->views;
            })
        );
    }

    public function getIsActiveAttribute()
    {
        if (in_array($this->status, [1, 2, 8])) {
            return true;
        }

        return false;
    }

    public function getCanBeEditedAttribute()
    {
        if ($this->allowed_to_edit && $this->software_file) {
            return true;
        }

        return false;
    }

    public function scopeApproved($query)
    {
        return $query->whereIn('status', [1, 2, 8, 9]);
    }

    public function scopeForRecording($query)
    {
        return $query->whereIn('status', [7]);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', [4]);
    }

    public function scopeDenied($query)
    {
        return $query->whereIn('status', [5]);
    }

    public function getDeniedAttribute() {
        return $this->status == 5;
    }

    public function getPendingAttribute() {
        return $this->status == 4;
    }

    public function scopeWaitingForIthibati($query)
    {
        return $query->whereIn('status', [6]);
    }

    public function scopeWithIthibati($query)
    {
        return $query->whereIn('status', [7,8]);
    }

    public function scopeWithNoIthibati($query)
    {
        return $query->whereIn('status', [9]);
    }

    public function scopeOwnedBy($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeCategory($query, $categoryId)
    {
        $ids = DB::table('song_categories')->where('category_id', $categoryId)->get()->pluck('song_id');

        return $query->whereIn('id', $ids);
    }

    public function scopeTopTen($query)
    {
        $topTen = SongDownload::selectRaw('sum(downloads) as downloads, song_id')
                ->groupBy('song_id')
                ->orderBy('downloads', 'desc')
                ->limit(10)
                ->get()
                ->pluck('song_id');

        return $query->whereIn('id', $topTen);
    }

    public function scopeWeeklyTopTen($query)
    {
        $now = Carbon::now();

        $topTen = SongDownload::selectRaw('sum(downloads) as downloads, song_id')
                ->whereBetween('downloaded_on', [
                    $now->startOfWeek()->format('Y-m-d'),
                    $now->endOfWeek()->format('Y-m-d')
                ])
                ->groupBy('song_id')
                ->orderBy('downloads', 'desc')
                ->limit(10)
                ->get()
                ->pluck('song_id');

        return $query->whereIn('id', $topTen);
    }
}
