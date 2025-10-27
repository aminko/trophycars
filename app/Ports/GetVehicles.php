<?php
declare(strict_types=1);

namespace App\Ports;

use App\DTO\GameplayVehiclesDto;

interface GetVehicles
{
    public function get(int $perPage): GameplayVehiclesDto;
}
