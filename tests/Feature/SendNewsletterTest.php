<?php

namespace Tests\Feature;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendNewsletterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sends_newsletter_to_all_subscribers()
    {
        Mail::fake();

        $subscribers = Newsletter::factory()->count(5)->create();

        $this->artisan('newsletter:send')->assertExitCode(0);

        Mail::assertQueued(NewsletterMail::class, 5);
    }
}
