<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\StapleRepositoryInterface;
use App\Models\Staple;
use Illuminate\Http\Request;

class StapleRepository implements StapleRepositoryInterface
{
    public function getAll(): array
    {
        return Staple::all()->toArray();
    }

    public function find(string $name): ?Staple
    {
        return Staple::where('name', $name)->first();
    }

    public function paginate(int $perPage): array
    {
        return Staple::orderBy('appearences', 'desc')->paginate($perPage)->toArray();
    }
}
