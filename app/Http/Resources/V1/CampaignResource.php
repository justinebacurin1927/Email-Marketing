<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'status' => $this->status,
            'send_date' => $this->send_date,
            'template' => new MessageTemplateResource($this->whenLoaded('template')),
            'contacts_count' => $this->whenCounted('contacts'),
            'recipients_count' => $this->contacts->count() + $this->tags->sum(fn($t) => $t->contacts->count()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
