<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CommanderServiceInterface
{
    public function getAll(): array;
    public function find(int $id): ?Model;
    public function paginate(int $perPage): array;
}
