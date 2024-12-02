<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StapleServiceInterface;
use Illuminate\Http\Request;

class StapleController extends Controller
{
    private StapleServiceInterface $stapleService;

    public function __construct(StapleServiceInterface $stapleService)
    {
        $this->stapleService = $stapleService;
    }

    /**
     * Display a listing of all staples.
     */
    public function index()
    {
        return response()->json($this->stapleService->getAll());
    }

    /**
     * Display the specified staple.
     */
    public function show(string $name)
    {
        return response()->json($this->stapleService->find($name));
    }

    /**
     * Display a listing of all staples with pagination.
     */
    public function paginate(int $perPage)
    {
        return response()->json($this->stapleService->paginate($perPage));
    }
}
