<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterSubscribeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_subscribe_to_newsletter()
    {
        $response = $this->post('/api/subscribe', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('newsletters', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
    }
}
