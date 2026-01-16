<?php

namespace App\Repositories\Interfaces;

interface TaskInterface
{
    public function getAllTask();
    public function create(array $data);
    public function findByID($id);
    public function update($id,$data);
    public function restoreTask($id);
}
