<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JenisCutiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'jenis_cuti' => $this->jenis_cuti,
            'jatah_hari' => $this->jatah_hari,
            'require_end_date' => $this->require_end_date,
            'require_attachment' => $this->require_attachment,
        ];
    }
}
