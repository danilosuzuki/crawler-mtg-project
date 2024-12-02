<?php

namespace Tests\Feature;

use App\Models\Inspiration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class DatabaseRenewTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_clears_the_inspiration_table()
    {
        Inspiration::factory()->count(2)->create();

        $this->assertDatabaseCount('inspirations', 2);

        $this->artisan('database:renew')->assertExitCode(0);

        $this->assertDatabaseCount('inspirations', 0);
    }
}
