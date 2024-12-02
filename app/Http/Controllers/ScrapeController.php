<?php

namespace App\Http\Controllers;

use App\Jobs\ScrapeApiJob;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    public function scrape()
    {
        ScrapeApiJob::dispatch();
        return response()->json(['message' => 'Scraping job dispatched']);
    }
}
