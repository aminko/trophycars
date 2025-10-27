<?php
declare(strict_types=1);

namespace App\DTO;

final readonly class GameplayVehiclesDto
{
    public function __construct(
        public array $vehicles,
        public array $meta,
        public array $links,
    ) {}

    public function toArray(): array
    {
        return array_map(
            fn($vehicle) => [
                "id" => $vehicle["id"],
                "name" => $vehicle["name"],
                "type" => $vehicle["type"],
                "price" => $vehicle["price"],
            ],
            $this->vehicles,
        );
    }
}
