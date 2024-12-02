<?php

namespace App\Http\Interfaces;

use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Collection;

interface NewsletterRepositoryInterface
{
    public function getContent(): Collection;
    public function sendAll(): Collection;
    public function send(string $name): Newsletter;
    public function subscribe(string $email, string $name): Newsletter;
    public function unsubscribe(string $email, string $token): Newsletter;
}
