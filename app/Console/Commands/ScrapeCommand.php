<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScrapeController;
use Illuminate\Console\Command;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the ScrapeApiJob';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scrapeController = new ScrapeController();
        $scrapeController->scrape();
        $this->info('Scraping job executed successfully.');
    }
}
