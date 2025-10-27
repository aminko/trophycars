<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ConflictException;
use App\Exceptions\NotEnoughMoneyException;
use App\Models\User;
use App\Models\Vehicle;
use App\Ports\GameplayStore;
use DB;

final class GameplayStoreService implements GameplayStore
{
    public function __construct() {}

    public function purchaseVehicle(int $userId, int $vehicleId): void
    {
        // this is a bit lazy, but shows the direction for end design

        $vehicle = Vehicle::find($vehicleId);
        DB::transaction(function () use ($userId, $vehicle) {
            $user = User::lockForUpdate()->find($userId);

            if ($user->hasVehicle($vehicle->id)) {
                throw new ConflictException("User already owns this vehicle"); // 409
            }

            if (!$user->canAffordVehicle($vehicle)) {
                throw new NotEnoughMoneyException(); // 422
            }

            $user->deductFromBalance($vehicle->price);
            $user->vehicles()->attach($vehicle->id, ["purchased_at" => now()]);
        });
    }
}
