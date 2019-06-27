<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SongCollection;
use App\Models\Category;
use App\Models\Song;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(
            Category::all()->sortBy('title')
        );
    }
    
    public function show(Category $category) {        
        return new SongCollection(
            Song::with(
                [
                    'categories', 'user', 'composer'
                ]
            )
                ->whereNotNull('user_id')
                ->approved()->category($category->id)->orderBy('name')->paginate()
        );
    }
}
