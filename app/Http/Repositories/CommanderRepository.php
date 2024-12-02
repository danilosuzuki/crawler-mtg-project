<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CommanderRepositoryInterface;
use App\Models\Commander;
use Illuminate\Http\Request;

class CommanderRepository implements CommanderRepositoryInterface
{
    public function getAll(): array
    {
        return Commander::all()->toArray();
    }

    public function find(int $id): ?Commander
    {
        return Commander::find($id);
    }

    public function paginate(int $perPage): array
    {
        return Commander::paginate($perPage)->toArray();
    }
}
