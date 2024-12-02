<?php

namespace App\Http\Services;

use App\Http\Interfaces\CommanderRepositoryInterface;
use App\Http\Interfaces\CommanderServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommanderService implements CommanderServiceInterface
{
    private CommanderRepositoryInterface $commanderRepository;

    public function __construct(CommanderRepositoryInterface $commanderRepository)
    {
        $this->commanderRepository = $commanderRepository;
    }

    public function getAll(): array
    {
        return $this->commanderRepository->getAll();
    }

    public function find(int $id): ?Model
    {
        return $this->commanderRepository->find($id);
    }

    public function paginate(int $perPage): array
    {
        return $this->commanderRepository->paginate($perPage);
    }
}
