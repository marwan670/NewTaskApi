<?php

namespace App\Factories;

use App\Repositories\Eloquent\TaskRepository;
use App\Repositories\Interfaces\TaskInterface;

class TaskRepositoryFactory
{
    public static function make(): TaskInterface
    {
        return new TaskRepository();
    }
}
