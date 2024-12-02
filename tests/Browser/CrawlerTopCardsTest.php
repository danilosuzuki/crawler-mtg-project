<?php

namespace Tests\Browser;

use App\Models\Commander;
use App\Models\Inspiration;
use App\Models\Staple;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrawlerTopCardsTest extends DuskTestCase
{
    /**
     * Crawler for top cards for each commanders.
     */
    public function testCrawlTopCards(): void
    {
        //Clear the database before starting the tests.
        DB::table('staples')->truncate();

        $this->browse(function (Browser $browser) {
            $urls = Commander::pluck('url')->toArray();

            foreach ($urls as $url) {
                $browser->visit('https://edhrec.com/' . $url . '#topcards')
                    ->assertSee('Top Cards')
                    ->waitFor('#topcards .CardImage_container__4_PKo a img', 10);
                $browser->maximize();
                $cards = $browser->elements('#topcards .CardImage_container__4_PKo a img');
                foreach ($cards as $card) {
                    $name = $card->getAttribute('alt');
                    $staple = Staple::firstOrNew(['name' => $name]);
                    $staple->appearences = $staple->appearences + 1;
                    $staple->image = $card->getAttribute('src');
                    $staple->save();
                }
                $browser->pause(1000);
            }
        });

        Staple::orderBy('appearences', 'desc')->take(5)->get()->each(function ($staple) {
            Inspiration::updateOrCreate(
                ['name' => $staple->name],
                ['image' => $staple->image, 'is_commander' => 0, 'value' => $staple->appearences]
            );
        });
    }
}
