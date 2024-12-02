<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\NewsletterRepositoryInterface;
use App\Models\Inspiration;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class NewsletterRepository implements NewsletterRepositoryInterface
{
    public function getContent(): Collection
    {
        return Inspiration::all();
    }

    public function sendAll(): Collection
    {
        return Newsletter::all();
    }

    public function send(string $name): Newsletter
    {
        return Newsletter::where('name', $name)->first();
    }

    public function subscribe(string $email, string $name): Newsletter
    {
        $newsletter = new Newsletter();
        $newsletter->email = $email;
        $newsletter->name = $name;
        $newsletter->status = 'subscribed';
        $newsletter->token = md5($email);
        $newsletter->save();
        return $newsletter;
    }

    public function unsubscribe(string $email, string $token): Newsletter
    {
        $newsletter = Newsletter::where('email', $email)->where('token', $token)->first();
        $newsletter->status = 'unsubscribed';
        $newsletter->save();
        return $newsletter;
    }
}
