<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CommanderServiceInterface;
use Illuminate\Http\Request;

class CommanderController extends Controller
{
    private CommanderServiceInterface $commanderService;

    public function __construct(CommanderServiceInterface $commanderService)
    {
        $this->commanderService = $commanderService;
    }

    /**
     * Display a page of all commanders.
     */
    public function indexWeb()
    {
        return view('/cards/commander');
    }

    /**
     * Display a listing of all commanders.
     */
    public function index()
    {
        return response()->json($this->commanderService->getAll());
    }

    /**
     * Display the specified commander.
     */
    public function show(string $id)
    {
        return response()->json($this->commanderService->find($id));
    }

    /**
     * Display a listing of all commanders with pagination.
     */
    public function paginate(int $perPage)
    {
        return response()->json($this->commanderService->paginate($perPage));
    }
}
