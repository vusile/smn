<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Composer;
use App\Models\Song;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap of the site.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">';

        $sitemap .= '<url>';
        $sitemap .= '<loc>https://swahilimusicnotes.com</loc>';
        $sitemap .= '<lastmod>'. Carbon::create(null, null, null, null, null, null) . '</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        $categories = Category::all();

        foreach($categories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://swahilimusicnotes.com/makundi-nyimbo/' . $category->url . '/' . $category->id . '</loc>';
            $sitemap .= '<lastmod>'. Carbon::create(null, null, null, null, null, null) . '</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.9</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '<url>';
        $sitemap .= '<loc>https://swahilimusicnotes.com/watunzi</loc>';
        $sitemap .= '<lastmod>'. Carbon::create(null, null, null, null, null, null) . '</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>0.6</priority>';
        $sitemap .= '</url>';

        $composers = Composer::all();

        foreach($composers as $composer) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://swahilimusicnotes.com/watunzi/nyimbo/' . $composer->url . '/' . $composer->id . '</loc>';
            $sitemap .= '<lastmod>'. Carbon::create(null, null, null, null, null, null) . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.6</priority>';
            $sitemap .= '</url>';
        }

        $songs = Song::with(
            [
                'categories', 'composer'
            ]
        )
            ->approved()->orderBy('name')->get();

        foreach($songs as $song) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://swahilimusicnotes.com/wimbo/' . $song->url . '/' . $song->id . '</loc>';
            $sitemap .= '<lastmod>'. Carbon::create(null, null, null, null, null, null) . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        Storage::put('sitemaps/sitemap.xml', $sitemap, 'public');

        //Ping Google
        Http::get('https://www.google.com/ping?sitemap=https://swahilimusicnotes.com/sitemap.xml');

    }
}
