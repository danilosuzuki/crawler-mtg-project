<?php

namespace Tests\Browser;

use App\Models\Commander;
use App\Models\Inspiration;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrawlerCommanderTest extends DuskTestCase
{
    /**
     * Crawler for top 100 commander of the last two years.
     */
    public function testCrawlTwoYears(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize();
            $browser->visit('https://edhrec.com/commanders')
                ->assertSee('Top Commanders (Past 2 Years)')
                ->waitFor('.CardImage_container__4_PKo a img', 10);

            $browser->scrollIntoView('.Grid_loadMore__1wSDP');
            $browser->pause(2000);

            $commandersUrl = $browser->elements('.CardImage_container__4_PKo a');
            $commandersName = $browser->elements('.CardImage_container__4_PKo a img');

            $urls = [];
            $names = [];
            $images = [];

            foreach ($commandersUrl as $commander) {
                $urls[] = $commander->getAttribute('href');
            }

            foreach ($commandersName as $commander) {
                $names[] = $commander->getAttribute('alt');
                $images[] = $commander->getAttribute('src');
            }

            for ($i = 0; $i < count($urls); $i++) {
                Commander::updateOrCreate(
                    ['name' => $names[$i]],
                    ['url' => $urls[$i], 'image' => $images[$i]]
                );
            }
        });
    }

    /**
     * Crawler for top 100 commander of the month.
     */
    public function testCrawlMonthly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize();
            $browser->visit('https://edhrec.com/commanders/month')
                ->assertSee('Top Commanders (Past Month)')
                ->waitFor('.CardImage_container__4_PKo a img', 10);

            $browser->scrollIntoView('.Grid_loadMore__1wSDP');
            $browser->pause(2000);

            $commandersUrl = $browser->elements('.CardImage_container__4_PKo a');
            $commandersName = $browser->elements('.CardImage_container__4_PKo a img');

            $urls = [];
            $names = [];
            $images = [];

            foreach ($commandersUrl as $commander) {
                $urls[] = $commander->getAttribute('href');
            }

            foreach ($commandersName as $commander) {
                $names[] = $commander->getAttribute('alt');
                $images[] = $commander->getAttribute('src');
            }

            for ($i = 0; $i < count($urls); $i++) {
                Commander::updateOrCreate(
                    ['name' => $names[$i]],
                    ['url' => $urls[$i], 'image' => $images[$i]]
                );
            }
        });
    }

    /**
     * Crawler for top 100 commander of the week.
     */
    public function testCrawlWeekly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize();
            $browser->visit('https://edhrec.com/commanders/week')
                ->assertSee('Top Commanders (Past Week)')
                ->waitFor('.CardImage_container__4_PKo a img', 10);

            $browser->scrollIntoView('.Grid_loadMore__1wSDP');
            $browser->pause(1000);

            $commandersUrl = $browser->elements('.CardImage_container__4_PKo a');
            $commandersName = $browser->elements('.CardImage_container__4_PKo a img');

            $urls = [];
            $names = [];
            $images = [];

            foreach ($commandersUrl as $commander) {
                $urls[] = $commander->getAttribute('href');
            }

            foreach ($commandersName as $commander) {
                $names[] = $commander->getAttribute('alt');
                $images[] = $commander->getAttribute('src');
            }

            for ($i = 0; $i < count($urls); $i++) {
                Commander::updateOrCreate(
                    ['name' => $names[$i]],
                    ['url' => $urls[$i], 'image' => $images[$i]]
                );
                if ($i < 5) {
                    Inspiration::updateOrCreate(
                        ['name' => $names[$i]],
                        ['image' => $images[$i], 'is_commander' => 1]
                    );
                }
            }
        });
    }
}
