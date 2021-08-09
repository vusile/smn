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

        $sitemap .= $this->generateUrlNode("", "daily", "1.0");

        $categories = Category::all();

        foreach($categories as $category) {
            $loc = '/makundi-nyimbo/' . $category->url . '/' . $category->id;
            $sitemap .= $this->generateUrlNode($loc, 'daily', '0.9');
        }

        $sitemap .= $this->generateUrlNode("/watunzi", "daily", "0.6");

        $composers = Composer::all();

        foreach($composers as $composer) {
            $loc = '/watunzi/nyimbo/' . $composer->url . '/' . $composer->id;
            $sitemap .= $this->generateUrlNode($loc, "weekly", "0.6");
        }

        $songs = Song::with(
            [
                'categories', 'composer'
            ]
        )
            ->approved()->orderBy('name')->get();

        foreach($songs as $song) {
            $loc = '/wimbo/' . $song->url . '/' . $song->id;
            $sitemap .= $this->generateUrlNode($loc, "monthly", "0.8");
        }

        $sitemap .= '</urlset>';

        Storage::put('sitemaps/sitemap.xml', $sitemap, 'public');

        //Ping Google
        Http::get('https://www.google.com/ping?sitemap=https://swahilimusicnotes.com/sitemap.xml');

    }

    private function generateUrlNode($loc, $changeFreq, $priority): string
    {
        $node = '<url>';
        $node .= '<loc>https://swahilimusicnotes.com'. $loc .'</loc>';
        $node .= '<lastmod>'. date('Y-m-d') . '</lastmod>';
        $node .= '<changefreq>'. $changeFreq . '</changefreq>';
        $node .= '<priority>'. $priority .'</priority>';
        $node .= '</url>';

        return $node;
    }
}
