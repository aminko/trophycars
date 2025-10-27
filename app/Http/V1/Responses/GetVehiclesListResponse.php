<?php
declare(strict_types=1);

namespace App\Http\V1\Responses;

class GetVehiclesListResponse extends PaginatedBaseResponse
{
    public function toArray($request): array
    {
        return [
            "data" => $this->collection->toArray(),
            "links" => $this->resourceLinks,
            "meta" => $this->resourceMeta,
        ];
    }
}
