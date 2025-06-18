<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentFrequencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'amount' => $this->amount,
            'frequencies' => $this->whenLoaded('frequencies', function () {
                return [
                    'moment_day' => $this->frequencies->moment_day,
                    'hour' => $this->frequencies->hour,
                ];
            }),
        ];
    }
}
