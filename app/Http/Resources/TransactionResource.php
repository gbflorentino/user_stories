<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
	    'user_id' => $this->user_id,
	    'category_id' => $this->category_id,
	    'transaction_type' => $this->transaction_type,
	    'amount' => $this->amount,
	    'created_ad' => $this->created_at
	];
    }
}
