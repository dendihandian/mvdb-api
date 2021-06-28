<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->collection->map(function ($person) {
            return new PersonResource($person);
        });

        $response_body = [
            'meta' => [
                'current_page' => $this->currentPage(),
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => (int) $this->perPage(),
                'last_page' => $this->lastPage(),
            ],
            'data' => $data,
        ];

        return $response_body;
    }
}
