<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        $response_body = [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'released_date' => $this->released_date,
        ];

        return $response_body;
    }
}
