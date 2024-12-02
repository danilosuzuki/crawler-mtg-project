<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CardServiceInterface;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private CardServiceInterface $cardService;

    public function __construct(CardServiceInterface $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * Display a listing of all cards.
     */
    public function index()
    {
        return response()->json($this->cardService->getAll());
    }

    /**
     * Display the specified card.
     */
    public function show(string $name)
    {
        return response()->json($this->cardService->find($name));
    }

    /**
     * Display the specified card.
     */
    public function showWeb(string $name)
    {
        return view('/cards/single', ['card' => $this->cardService->find($name)]);
    }

    /**
     * Display a listing of all cards with pagination.
     */
    public function paginate(int $perPage)
    {
        return response()->json($this->cardService->paginate($perPage));
    }
}
