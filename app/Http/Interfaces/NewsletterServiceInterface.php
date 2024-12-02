<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface NewsletterServiceInterface
{
    public function sendAll(): array;
    public function send(string $name): Model;
    public function subscribe(string $email, string $name): Model;
    public function unsubscribe(string $email, string $token): Model;
}
