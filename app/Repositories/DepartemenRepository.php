<?php

namespace App\Repositories;

use App\Http\Resources\Collection\DepartemenCollection;
use App\Http\Resources\DepartemenResource;
use App\Models\Departemen;

class DepartemenRepository
{
    protected $departemen;

    /**
     * @param $departemen
     */
    public function __construct(Departemen $departemen)
    {
        $this->departemen = $departemen;
    }

    public function getData(mixed $search,$perPage)
    {
        $query = $this->departemen->query();

        if (!empty($search)) {
            $query->where('departemen', 'like', '%' . $search . '%');
        }

        $data = $query->paginate($perPage);
        return new DepartemenCollection($data);
    }

    public function store(mixed $data)
    {
        return $this->departemen->create($data);
    }

    public function update(mixed $data, $id)
    {
        return $this->departemen->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->departemen->where('id',$id)->delete();

    }

    public function getDepartementById($id)
    {
        $data = $this->departemen->where('id',$id)->firstOrFail();
        return new DepartemenResource($data);
    }

}
