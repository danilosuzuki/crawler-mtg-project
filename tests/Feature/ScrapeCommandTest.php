<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Commander;
use App\Models\Staple;

class ScrapeCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_runs_the_scrape_command()
    {
        Http::fake([
            'https://api.scryfall.com/cards/named*' => Http::response([
                'name' => 'Test Card',
                'scryfall_uri' => 'https://scryfall.com/card/test',
                'image_uris' => ['normal' => 'https://scryfall.com/card/test.jpg'],
                'type_line' => 'Creature',
                'oracle_text' => 'Test text',
                'cmc' => 3,
                'colors' => ['B'],
            ], 200),
        ]);

        Commander::factory()->create(['name' => 'Test Card']);
        Staple::factory()->create(['name' => 'Test Card']);

        $this->artisan('scrape:run')->assertExitCode(0);

        $this->assertDatabaseHas('cards', [
            'name' => 'Test Card',
            'scryfall_uri' => 'https://scryfall.com/card/test',
            'image' => 'https://scryfall.com/card/test.jpg',
            'type' => 'Creature',
            'text' => 'Test text',
            'cmc' => 3,
            'black' => 1,
        ]);
    }
}
