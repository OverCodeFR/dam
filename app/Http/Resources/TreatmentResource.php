<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dosage' => $this->dosage,
            'start_at' =>$this->start_at,
            'end_at' => $this->end_at,
            'is_done' => $this->is_done,
            'treatment_type' => $this->treatment_type->makeHidden('id'),
            'treatment_frequencies' => TreatmentFrequencyResource::collection($this->whenLoaded('treatment_frequencies')),
            'stock' => StockResource::collection($this->stock),
        ];
    }
}
