<?php
declare(strict_types=1);

namespace App\Infrastructure;

use App\DTO\GameplayVehiclesDto;
use App\Models\Vehicle;
use App\Ports\GetVehicles;

class DatabaseGetVehicles implements GetVehicles
{
    private const MIN_PER_PAGE = 1;
    private const MAX_PER_PAGE = 50;

    public function get(int $perPage): GameplayVehiclesDto
    {
        // 1 < perPage < 50
        $perPage = max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));

        $vehicles = Vehicle::query()
            ->select("id", "name", "type", "price")
            ->orderBy("id")
            ->cursorPaginate($perPage);

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
