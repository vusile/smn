<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\CategoryCollection;
use App\Http\Resources\Collections\SongCollection;
use App\Models\Category;

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
            $category->songs()->paginate()->where('status', 1)->sortBy('name')
        );
    }
}
