<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use RuntimeException;
use Throwable;

class ConflictException extends RuntimeException
{
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct(message: $message, previous: $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json(
            [
                "error" => "Conflict",
                "message" => $this->getMessage(),
            ],
            JsonResponse::HTTP_CONFLICT,
        );
    }
}
