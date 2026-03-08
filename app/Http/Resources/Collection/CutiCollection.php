<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\CutiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CutiCollection extends ResourceCollection
{
    protected function collects()
    {
        return CutiResource::class;
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
