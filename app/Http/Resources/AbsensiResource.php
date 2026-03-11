<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AbsensiResource extends JsonResource
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
            'karyawan' => optional($this->karyawan)->nama,
            'tanggal' => $this->tanggal
                ? Carbon::parse($this->tanggal)->translatedFormat('l, d F Y')
                : null,
            'jam_masuk' => $this->jam_masuk
                ? Carbon::parse($this->jam_masuk)->translatedFormat('H:i')
                : null,
            'jam_keluar' => $this->jam_keluar
                ? Carbon::parse($this->jam_keluar)->translatedFormat('H:i')
                : null,
            'status' => ucfirst($this->status),
        ];
    }
}
