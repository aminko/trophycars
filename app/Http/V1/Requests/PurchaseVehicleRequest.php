<?php
declare(strict_types=1);

namespace App\Http\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "userId" => ["required", "exists:users,id"],
            "vehicleId" => ["required", "exists:vehicles,id"],
        ];
    }

    public function userId(): int
    {
        return (int) $this->validated()["userId"];
    }

    public function vehicleId(): int
    {
        return (int) $this->validated()["vehicleId"];
    }
}
