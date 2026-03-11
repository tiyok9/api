<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GraphClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sisa_cuti' => $this['sisa_cuti'],
            'pending_cuti' => $this['pending_cuti'],
            'absen_hari_ini' => $this['absen_hari_ini'],
        ];
    }
}
