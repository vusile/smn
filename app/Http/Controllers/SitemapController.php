<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function index() {
        $sitemap = Storage::get('sitemaps/sitemap.xml');
        return response($sitemap, 200)->header('Content-Type', 'application/xml');
    }
}
