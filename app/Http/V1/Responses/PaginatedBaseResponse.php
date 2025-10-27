<?php
declare(strict_types=1);

namespace App\Http\V1\Responses;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedBaseResponse extends ResourceCollection
{
    protected readonly array $resourceLinks;
    protected readonly array $resourceMeta;

    public function __construct(
        mixed $resource,
        array $links = [],
        array $meta = [],
    ) {
        parent::__construct($resource);
        $this->resourceLinks = $links;
        $this->resourceMeta = $meta;
    }
}
