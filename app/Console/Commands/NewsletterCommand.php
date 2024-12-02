<?php

namespace App\Console\Commands;

use App\Http\Controllers\NewsletterController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to all subscribers.';

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
        Log::info('sendAll - Sending newsletter to all subscribers.');
        $newsletterController = app(NewsletterController::class);
        $newsletterController->sendAll();
        $this->info('sendAll - Newsletter sent successfully.');
    }
}
