<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

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

        $approvedSongs = Song::with(
                [
                    'categories', 'composer'
                ]
            )
                ->approved()->category($category->id)->orderBy('name')->get();
//        dd($category->songs);
 //       $approvedSongs = $category->approvedSongs;

        return view(
            'categories.show',
            compact('category', 'approvedSongs')
        );
    }
}
