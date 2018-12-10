<?php

namespace App\Service;

use Illuminate\Support\ServiceProvider;

class SearchProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Search::class, AmazonSearch::class);
    }
}
