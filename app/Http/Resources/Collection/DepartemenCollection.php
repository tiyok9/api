<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\DepartemenResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartemenCollection extends ResourceCollection
{
    protected function collects()
    {
        return DepartemenResource::class;
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
