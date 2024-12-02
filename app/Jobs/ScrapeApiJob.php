<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Commander;
use App\Models\Staple;
use App\Models\Card;

class ScrapeApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('ScrapeApiJob started');
        $commanderNamesRaw = Commander::pluck('name')->toArray();
        $commanderNames = [];
        foreach ($commanderNamesRaw as $name) {
            $splitNames = explode(' // ', $name);
            $commanderNames = array_merge($commanderNames, $splitNames);
        }
        $stapleNames = Staple::pluck('name')->toArray();
        $names = array_merge($commanderNames, $stapleNames);
        $url = 'https://api.scryfall.com/cards/named?exact=';
        foreach ($names as $name) {
            if(Card::where('name', $name)->doesntExist()) {
                $response = Http::get($url . urlencode($name));
                $response = $response->json();

                if (isset($response['name'])) {
                    Card::updateOrCreate(
                        ['name' => $name],
                        [
                            'scryfall_uri' => $response['scryfall_uri'] ?? '',
                            'image' => $response['image_uris']['normal'] ?? '',
                            'type' => is_array($response['type_line']) ? implode(', ', $response['type_line']) : $response['type_line'],
                            'text' => $response['oracle_text'] ?? '',
                            'cmc' => $response['cmc'] ?? 0,
                            'black' => in_array('B', $response['colors'] ?? []) ? 1 : 0,
                            'blue' => in_array('U', $response['colors'] ?? []) ? 1 : 0,
                            'green' => in_array('G', $response['colors'] ?? []) ? 1 : 0,
                            'red' => in_array('R', $response['colors'] ?? []) ? 1 : 0,
                            'white' => in_array('W', $response['colors'] ?? []) ? 1 : 0,
                        ]
                    );
                } else {
                    Log::info('Card not found: ' . $name);
                }

                // Adding one second between each request to avoid rate limiting from scryfall
                sleep(1);
            }else{
                Log::info('Card already exists: ' . $name);
            }
        }
        Log::info('ScrapeApiJob done');
    }
}