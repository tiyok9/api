<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\JabatanResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JabatanCollection extends ResourceCollection
{
    protected function collects()
    {
        return JabatanResource::class;
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
