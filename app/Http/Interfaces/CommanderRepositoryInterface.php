<?php

namespace App\Http\Interfaces;

use App\Models\Commander;

interface CommanderRepositoryInterface
{
    public function getAll(): array;
    public function find(int $id): ?Commander;
    public function paginate(int $perPage): array;
}
