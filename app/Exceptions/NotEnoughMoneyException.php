<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class NotEnoughMoneyException extends \Exception
{
    public function __construct()
    {
        parent::__construct("User does not have enough money");
    }

    public function render(): JsonResponse
    {
        return response()->json(
            $this->message,
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
        );
    }
}
