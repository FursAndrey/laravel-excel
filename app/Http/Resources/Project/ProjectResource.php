<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Type\TypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type' => new TypeResource($this->type),
            'title' => $this->title,
            'date_created' => $this->date_created ?? null,
            'setevik' => $this->setevik ? 'Да' : 'Нет',
            'member_count' => $this->member_count,
            'has_outsource' => $this->has_outsource ? 'Да' : 'Нет',
            'has_investors' => $this->has_investors ? 'Да' : 'Нет',
            'date_deadline' => $this->date_deadline ?? null,
            'on_time' => $this->on_time ? 'Да' : 'Нет',
            'date_signed' => $this->date_signed ?? null,
            'service_count' => $this->service_count,
        ];
    }
}
