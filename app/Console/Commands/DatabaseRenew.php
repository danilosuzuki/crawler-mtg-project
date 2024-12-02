<?php

namespace App\Console\Commands;

use App\Models\Inspiration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DatabaseRenew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all data from the inspiration table.';

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
        Log::info('cleanse - Clearing the Inspiration Table.');
        Inspiration::truncate();
        Log::info('cleanse - Inspiration Table has been cleared.');
    }
}
