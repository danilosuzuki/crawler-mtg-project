<?php

namespace App\Http\Services;

use App\Http\Interfaces\CardRepositoryInterface;
use App\Http\Interfaces\CardServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CardService implements CardServiceInterface
{
    private CardRepositoryInterface $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function getAll(): array
    {
        return $this->cardRepository->getAll();
    }

    public function find(string $name): ?Model
    {
        return $this->cardRepository->find($name);
    }

    public function paginate(int $perPage): array
    {
        return $this->cardRepository->paginate($perPage);
    }
}
