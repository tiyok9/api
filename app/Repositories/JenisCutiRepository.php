<?php

namespace App\Repositories;

use App\Http\Resources\Collection\JenisCutiCollection;
use App\Http\Resources\JenisCutiResource;
use App\Models\JenisCuti;

class JenisCutiRepository
{
    protected $jenisCuti;

    /**
     * @param $jenisCuti
     */
    public function __construct(JenisCuti $jenisCuti)
    {
        $this->jenisCuti = $jenisCuti;
    }

    public function getData(mixed $search)
    {
        $query = $this->jenisCuti->query();

        if (!empty($search)) {
            $query->where('jenis_cuti', 'like', '%' . $search . '%');
        }

        $data = $query->paginate(10);
        return new JenisCutiCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->jenisCuti->create($data);
    }

    public function update(mixed $data, $id)
    {
        return $this->jenisCuti->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->jenisCuti->where('id',$id)->delete();

    }

    public function getJenisCutiById($id)
    {

        $data = $this->jenisCuti->where('id',$id)->firstOrFail();
        return new JenisCutiResource($data);

    }
}
