<?php

namespace App\Service;

interface UserService
{
    public function getData(mixed $search,$perPage);
    public function store(mixed $data);
    public function update(mixed $data, $id);
    public function destroy($id);
    public function getUserById($id);
}
