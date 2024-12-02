<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Jobs\ScrapeApiJob;
use App\Models\Commander;
use App\Models\Staple;

class ScrapeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_scrapes_data_and_updates_database()
    {
        Http::fake([
            'https://api.scryfall.com/cards/named*' => Http::response([
                'name' => 'Test Commander',
                'scryfall_uri' => 'https://scryfall.com/card/test',
                'image_uris' => ['normal' => 'https://scryfall.com/card/test.jpg'],
                'type_line' => 'Creature',
                'oracle_text' => 'Test text',
                'cmc' => 3,
                'colors' => ['B'],
            ], 200),
        ]);

        $commander = Commander::factory()->create(['name' => 'Test Commander']);
        $staple = Staple::factory()->create(['name' => 'Test Staple']);

        ScrapeApiJob::dispatch();

        $this->assertDatabaseHas('cards', [
            'name' => 'Test Commander',
            'scryfall_uri' => 'https://scryfall.com/card/test',
            'image' => 'https://scryfall.com/card/test.jpg',
            'type' => 'Creature',
            'text' => 'Test text',
            'cmc' => 3,
            'black' => 1,
        ]);

        $this->assertDatabaseHas('cards', [
            'name' => 'Test Staple',
            'scryfall_uri' => 'https://scryfall.com/card/test',
            'image' => 'https://scryfall.com/card/test.jpg',
            'type' => 'Creature',
            'text' => 'Test text',
            'cmc' => 3,
            'black' => 1,
        ]);
    }
}
