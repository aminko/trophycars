<?php
declare(strict_types=1);

namespace App\Http\V1;

use App\Http\V1\Requests\PurchaseVehicleRequest;
use App\Ports\GameplayStore;
use Illuminate\Http\JsonResponse;

final class PurchaseVehicleAdapter
{
    public function __construct(private GameplayStore $store) {}

    public function __invoke(PurchaseVehicleRequest $request): JsonResponse
    {
        $this->store->purchaseVehicle(
            $request->userId(),
            $request->vehicleId(),
        );

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
