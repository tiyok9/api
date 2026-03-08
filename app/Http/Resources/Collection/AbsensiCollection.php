<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\AbsensiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AbsensiCollection extends ResourceCollection
{
    protected function collects()
    {
        return AbsensiResource::class;
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
