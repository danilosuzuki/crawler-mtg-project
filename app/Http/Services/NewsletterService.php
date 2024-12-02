<?php

namespace App\Http\Services;

use App\Http\Interfaces\NewsletterRepositoryInterface;
use App\Http\Interfaces\NewsletterServiceInterface;
use App\Mail\NewsletterMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterService implements NewsletterServiceInterface
{
    private NewsletterRepositoryInterface $newsletterRepository;

    public function __construct(NewsletterRepositoryInterface $newsletterRepository)
    {
        $this->newsletterRepository = $newsletterRepository;
    }

    public function sendAll(): array
    {
        $subscribers = $this->newsletterRepository->sendAll();
        $content = $this->newsletterRepository->getContent();

        foreach ($subscribers as $subscriber) {
            if ($subscriber->status === 'subscribed')
                Mail::to($subscriber->email)->queue(new NewsletterMail($content));
        }

        return $subscribers->toArray();
    }

    public function send(string $name): Model
    {
        return $this->newsletterRepository->send($name);
    }

    public function subscribe(string $email, string $name): Model
    {
        return $this->newsletterRepository->subscribe($email, $name);
    }

    public function unsubscribe(string $email, string $token): Model
    {
        return $this->newsletterRepository->unsubscribe($email, $token);
    }
}
