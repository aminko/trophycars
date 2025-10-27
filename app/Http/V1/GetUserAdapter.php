<?php
declare(strict_types=1);

namespace App\Http\V1;

use App\Http\V1\Requests\GetUserRequest;
use App\Ports\GetGameplayUser;
use Illuminate\Http\Resources\Json\JsonResource;

final class GetUserAdapter
{
    public function __construct(private GetGameplayUser $gameplayUser)
    {
        //
    }

    public function __invoke(GetUserRequest $request): JsonResource
    {
        $user = $this->gameplayUser->getById($request->userId());

        return new JsonResource($user);
    }
}
