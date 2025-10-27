<?php
declare(strict_types=1);

namespace App\Infrastructure;

use App\DTO\GameplayUserDto;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Models\Vehicle;
use App\Ports\GetGameplayUser;
use Illuminate\Database\DatabaseManager;

class DatabaseGetGameplayUser implements GetGameplayUser
{
    public function __construct(private DatabaseManager $database) {}

    public function getById(int $id): GameplayUserDto
    {
        $user = User::with("vehicles")->find($id);

        if (!$user) {
            throw new UserNotFoundException($id);
        }

        return new GameplayUserDto(
            id: $user->id,
            name: $user->name,
            cash: $user->cash,
            ownedCars: [
                ...$user->vehicles->map(
                    fn(Vehicle $vehicle) => [
                        "id" => $vehicle->id,
                        "name" => $vehicle->name,
                        "type" => $vehicle->type,
                        "purchasedAt" => $vehicle->pivot->purchased_at,
                    ],
                ),
            ],
        );
    }
}
