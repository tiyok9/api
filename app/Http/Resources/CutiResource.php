<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CutiResource extends JsonResource
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
            'jenis_cuti' => optional($this->jenisCuti)->jenis_cuti,
            'tanggal_mulai' => Carbon::parse($this->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($this->tanggal_selesai)->translatedFormat('d F Y'),
            'jumlah_hari' => $this->jumlah_hari,
            'alasan' => $this->alasan,
            'status' => $this->status,
        ];
    }

}
