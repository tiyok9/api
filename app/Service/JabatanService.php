<?php

namespace App\Service;

interface JabatanService
{
    public function getData(mixed $search,$perPage);
    public function store(mixed $data);
    public function update(mixed $data, $id);
    public function destroy($id);
    public function getJabatanById($id);
}
