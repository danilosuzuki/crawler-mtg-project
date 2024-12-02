<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\NewsletterServiceInterface;
use App\Http\Requests\NewsletterSubscribeRequest;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    private NewsletterServiceInterface $newsletterService;

    public function __construct(NewsletterServiceInterface $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function subscribe(NewsletterSubscribeRequest $request)
    {
        return response()->json($this->newsletterService->subscribe($request->input('email'), $request->input('name')));
    }

    public function sendAll()
    {
        return response()->json($this->newsletterService->sendAll());
    }
}
