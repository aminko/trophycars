<?php
declare(strict_types=1);

namespace App\Http\V1;

use App\Http\V1\Requests\GetVehiclesRequest;
use App\Http\V1\Responses\GetVehiclesListResponse;
use App\Ports\GetVehicles;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class GetVehiclesAdapter
{
    public function __construct(private GetVehicles $vehicles) {}

    public function __invoke(GetVehiclesRequest $request): ResourceCollection
    {
        $list = $this->vehicles->get($request->perPage());

        return new GetVehiclesListResponse(
            $list->toArray(),
            $list->links,
            $list->meta,
        );
    }
}
