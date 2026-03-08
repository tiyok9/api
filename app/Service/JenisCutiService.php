<?php

namespace App\Service;

interface JenisCutiService
{
    public function getData(mixed $search);
    public function store(mixed $data);
    public function update(mixed $data, $id);
    public function destroy($id);
}
