<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpcomingTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request )
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'completed' => $this->completed,
            'waiting'   => $this->waiting,
            'taskId'    => $this->taskId,
        ];
    }
}