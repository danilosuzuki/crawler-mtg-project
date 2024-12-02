<?php

namespace App\Http\Services;

use App\Http\Interfaces\StapleRepositoryInterface;
use App\Http\Interfaces\StapleServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StapleService implements StapleServiceInterface
{
    private StapleRepositoryInterface $stapleRepository;

    public function __construct(StapleRepositoryInterface $stapleRepository)
    {
        $this->stapleRepository = $stapleRepository;
    }

    public function getAll(): array
    {
        return $this->stapleRepository->getAll();
    }

    public function find(string $name): ?Model
    {
        return $this->stapleRepository->find($name);
    }

    public function paginate(int $perPage): array
    {
        return $this->stapleRepository->paginate($perPage);
    }
}
