<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface StapleServiceInterface
{
    public function getAll(): array;
    public function find(string $name): ?Model;
    public function paginate(int $perPage): array;
}
