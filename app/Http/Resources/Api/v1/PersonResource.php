<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response_body = [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'first_name' => $this->first_name,
            'alias' => $this->alias,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
        ];

        return $response_body;
    }
}
