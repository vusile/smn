<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $title = "Taarifa mbalimbali";
        $description = "Taarifa mbalimbali juu ya matumizi ya Swahili Music Notes";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        $blogPosts = BlogPost::all()
            ->sortByDesc('id')
            ->filter(function ($blogPost) {
                return $blogPost->type == 2 
                       && !in_array(
                           $blogPost->id, 
                            [1,41,44,45,47,43,39,31,18,15,3,42,16,40,36]
                        );
            });
        
        return view(
            'pages.index',
            compact('blogPosts', 'title', 'description')
        );
    }
    
    public function show(string $slug, BlogPost $blogPost)
    {
        SEOMeta::setTitle($blogPost->title);
        SEOMeta::setDescription(strip_tags($blogPost->text));
        
        return view(
            'pages.show',
            compact('blogPost')
        );
    }
}