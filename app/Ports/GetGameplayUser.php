<?php
declare(strict_types=1);

namespace App\Ports;

use App\DTO\GameplayUserDto;
use App\Exceptions\UserNotFoundException;

interface GetGameplayUser
{
    /** @throws UserNotFoundException */
    public function getById(int $id): GameplayUserDto;
}
