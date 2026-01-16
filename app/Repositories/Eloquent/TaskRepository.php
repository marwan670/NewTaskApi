<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Interfaces\TaskInterface;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllTask()
    {
        return Task::where('user_id',Auth::id())->get();
    }

    public function create(array $data): Task
    {
        return Task::create([
            "title" => $data['title'],
            "description" => $data['description'],
            "status" => $data['status'],
            "user_id" => Auth::id(),
        ]);
    }

    public function findByID($id)
    {
        return Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
    }

    public function update($id, $data)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return null;
        }

        $task->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'status'      => $data['status'],
            'user_id'     => $data['user_id'],
        ]);

        return $task;
    }

    public function restoreTask($id)
    {
        return Task::withTrashed()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
    }
}
