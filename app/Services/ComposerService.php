<?php

namespace App\Services;

use App\Services\SearchService;

class ComposerService
{
    protected $searchService;
    
    public function __construct(SearchService $searchService) {
        $this->searchService = $searchService;
    }
    
    public function checkForDuplicates(
        string $composerName
    ){
        $composerParts = explode('.', $composerName);
        if(count($composerParts < 2)) {
            $composerParts = explode('.', $composerName);
        }
        
        $search = collect($composerParts)
            ->filter(function ($composerPart){
                 return strlen($composerPart) > 2; 
            })
            ->implode(' | '); 
     
        $results = $this->searchService
            ->search(
                $search,
                'composers'
            );
        
        return $results;
    }
}