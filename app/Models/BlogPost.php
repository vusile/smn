<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    public $timestamps = false;
    protected $table = 'pages'; 
    protected $fillable = ['title', 'text', 'browser_title', 'meta_description', 'type', 'url', 'document' , 'date_added'];
}
