<?php

namespace App\Repositories;

use App\Http\Resources\Collection\JabatanCollection;
use App\Http\Resources\JabatanResource;
use App\Models\Jabatan;

class JabatanRepsitory
{
    protected $jabatan;

    /**
     * @param $jabatan
     */
    public function __construct(Jabatan $jabatan)
    {
        $this->jabatan = $jabatan;
    }

    public function getData(mixed $search,$perPage)
    {
        $query = $this->jabatan->with('departemen');

        if (!empty($search)) {
            $query->where('jabatan', 'like', '%' . $search . '%');
        }

        $data = $query->paginate($perPage);
        return new JabatanCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->jabatan->create($data);
    }

    public function update(mixed $data, $id)
    {
        return $this->jabatan->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->jabatan->where('id',$id)->delete();

    }

    public function getJabatanById($id)
    {
        $data = $this->jabatan->where('id',$id)->with('departemen')->firstOrFail();
        return new JabatanResource($data);

    }
}
