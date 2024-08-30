<?php

namespace App\Http\Resources;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tenant' => new TenantResource($this->tenant),
            'date_paid' => $this->date_paid,
            'status' => $this->status ? 'Settled' : 'Unsettled',
            'due_date' =>$this->due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
