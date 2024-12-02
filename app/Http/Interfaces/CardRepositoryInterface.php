<?php

namespace App\Http\Interfaces;

use App\Models\Card;

interface CardRepositoryInterface
{
    public function getAll(): array;
    public function find(string $name): ?Card;
    public function paginate(int $perPage): array;
}
