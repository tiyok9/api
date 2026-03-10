<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\GraphResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GraphCollection extends ResourceCollection
{
    protected function collects()
    {
        return GraphResource::class;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
