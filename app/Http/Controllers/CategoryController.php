<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;

class CategoryController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Nyimbo za Kanisa');
        SEOMeta::setDescription('Nyimbo za Vipindi Mbalimbali vya Kanisa kwenye Swahili Music Notes');
        
        $categories = Category::all()
                ->sortBy('title');
        
        return view(
            'categories.index',
            compact('categories')
        );
    }
    
    public function show(string $slug, Category $category) {
      
        SEOMeta::setTitle($category->seo_title ?? $category->title);
        SEOMeta::setDescription("Mkusanyiko wa nyimbo za " . $category->title);
        
        $approvedSongs = $category->approvedSongs;
        
        return view(
            'categories.show',
            compact('category', 'approvedSongs')
        );
    }
}
