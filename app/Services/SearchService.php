<?php

namespace App\Services;

use sngrl\SphinxSearch\SphinxSearch;
use Sphinx\SphinxClient;

class SearchService
{
    public function search($searchString, $index = null)
    {
        $sphinx = new SphinxSearch();
        return $sphinx
            ->search(
                $searchString,
                $index
            )
            ->limit(1000)
            ->setMatchMode(SphinxClient::SPH_MATCH_ALL)
            ->setRankingMode(SphinxClient::SPH_SORT_RELEVANCE)
            ->get();
    }
    
    public function userSearch($searchString, $index = null)
    {
        $sphinx = new SphinxSearch();
        return $sphinx
            ->search(
                $searchString,
                $index
            )
            ->filter('user_id', [auth()->user()->id])
            ->get();
    }
}