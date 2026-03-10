<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RekapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_karyawan' => $this['total_karyawan'],
            'karyawan_aktif' => $this['karyawan_aktif'],
            'cuti_bulan_ini' => $this['cuti_bulan_ini'],
        ];
    }
}
