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
            'preferred_hour' => $this->preferred_hour,
            'moment_day' => $this->moment_day->makeHidden('id'),
            'frequency' => $this->frequency->makeHidden('id'),
        ];
    }
}
