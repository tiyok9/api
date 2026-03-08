<?php

namespace App\Service;

interface CutiService
{
    public function getData(mixed $search);
    public function store(mixed $data);
    public function update(mixed $data,$id);
}
