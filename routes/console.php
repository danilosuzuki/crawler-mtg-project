<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('database:renew')->weekly();
Schedule::command('dusk')->weekly();
Schedule::command('scrape:run')->weekly();
Schedule::command('newsletter:send')->weekly();
