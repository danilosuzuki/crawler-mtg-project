<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CardRepositoryInterface;
use App\Models\Card;
use Illuminate\Http\Request;

class CardRepository implements CardRepositoryInterface
{
    public function getAll(): array
    {
        return Card::all()->toArray();
    }

    public function find(string $name): ?Card
    {
        return Card::where('name', $name)->first();
    }

    public function paginate(int $perPage): array
    {
        return Card::paginate($perPage)->toArray();
    }
}
