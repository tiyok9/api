<?php

namespace App\Service;

interface AbsensiService
{
    public function getData(mixed $search,$perPage);
    public function absen(mixed $data);
    public function note(mixed $data,$id);
    public function getDataUser();
    public function getRekap();
    public function getExport();
}
