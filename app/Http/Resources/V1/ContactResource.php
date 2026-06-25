<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => trim("{$this->first_name} {$this->last_name}"),
            'company' => $this->company,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'street' => $this->street,
            'address2' => $this->address2,
            'city' => $this->city,
            'region' => $this->region,
            'postal' => $this->postal,
            'country' => $this->country,
            'subscribed' => $this->subscribed,
            'permission' => $this->permission,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
