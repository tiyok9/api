<?php

namespace App\Service\Impl;

use App\Notifications\NotificationUser;
use App\Repositories\CutiRepository;
use App\Service\CutiService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CutiServiceImpl implements CutiService
{
    protected $cuti;

    /**
     * @param $cuti
     */
    public function __construct(CutiRepository $cuti)
    {
        $this->cuti = $cuti;
    }

    public function getData($search = '', $perPage=10)
    {
        try {
            return $this->cuti->getData($search,$perPage);
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }

    public function store(mixed $data)
    {
        DB::beginTransaction();
        $imagePath = null;

        try {
            $tanggalMulai = Carbon::parse($data['tanggal_mulai']);
            $tanggalSelesai = Carbon::parse($data['tanggal_selesai']) ?? 0 ;

            $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
            if (isset($data['img']) && $data['img']->isValid()) {
                $filename = time() . '.' . $data['img']->extension();
                $imagePath = $data['img']->storeAs('cuti', $filename, 'public');
                $data['img'] = $imagePath;
            } else {
                unset($data['img']);
            }

            $data['id_karyawan'] = auth('api')->user()->karyawan->id;
            $data['status'] = 'pending';
            $data['jumlah_hari'] = $jumlahHari;
            $response = $this->cuti->store($data);
            if ($response) {
                $getAdmin = $this->cuti->getAdmin();
                $user = auth('api')->user();
                $start = Carbon::parse($data['tanggal_mulai'])->translatedFormat('d F Y');
                $end = Carbon::parse($data['tanggal_selesai'])->translatedFormat('d F Y');

                foreach ($getAdmin as $admin) {
                    $admin->notify(new NotificationUser(
                        'Request from ' . $user->karyawan->nama .
                        ' from ' . $start .
                        ' until ' . $end
                    ));
                }

                DB::commit();
                return true;
            }
            DB::commit();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update($data,$id)
    {
        DB::beginTransaction();
        try {
            $data['approved_by'] = auth()->user()->id;
            $data['approved_at'] = now();
            $response = $this->cuti->update($data,$id);
            if ($response) {
                DB::commit();
                return true;
            }
            DB::commit();
            return false;
        }catch (Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getExport()
    {
        try {
            return $this->cuti->getExport();
        }catch (Exception $e){
            Log::error($e->getMessage());
            return [];
        }
    }
}
