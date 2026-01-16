<?php

namespace App\Repositories\Interfaces;

interface UserInterface
{
    public function create(array $data);
    public function checkUserExists(array $data);
}
