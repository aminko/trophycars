<?php
declare(strict_types=1);

namespace App\Ports;

interface GameplayStore
{
    public function purchaseVehicle(int $userId, int $vehicleId): void;
}
