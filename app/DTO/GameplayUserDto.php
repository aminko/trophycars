<?php
declare(strict_types=1);

namespace App\DTO;

final readonly class GameplayUserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public int $cash,
        public array $ownedCars,
    ) {}

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "cash" => $this->cash,
            "ownedCars" => $this->ownedCars,
        ];
    }
}
