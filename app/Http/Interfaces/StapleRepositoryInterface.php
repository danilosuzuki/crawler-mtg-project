<?php

namespace App\Http\Interfaces;

use App\Models\Staple;

interface StapleRepositoryInterface
{
    public function getAll(): array;
    public function find(string $name): ?Staple;
    public function paginate(int $perPage): array;
}
