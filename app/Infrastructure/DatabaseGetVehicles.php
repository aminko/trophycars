<?php
declare(strict_types=1);

namespace App\Infrastructure;

use App\DTO\GameplayVehiclesDto;
use App\Models\Vehicle;
use App\Ports\GetVehicles;

class DatabaseGetVehicles implements GetVehicles
{
    private const MAX_PER_PAGE = 50;

    public function get(int $perPage): GameplayVehiclesDto
    {
        $perPage =
            $perPage < self::MAX_PER_PAGE ? $perPage : self::MAX_PER_PAGE;
        $vehicles = Vehicle::cursorPaginate($perPage);

        return new GameplayVehiclesDto(
            $vehicles->items(),
            [
                "per_page" => $perPage,
                "count" => $vehicles->count(),
                "has_more" => $vehicles->hasMorePages(),
            ],
            [
                "next_page" => $vehicles->nextPageUrl(),
                "previous_page" => $vehicles->previousPageUrl(),
            ],
        );
    }
}
