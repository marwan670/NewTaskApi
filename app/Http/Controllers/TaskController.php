<?php

namespace App\Http\Controllers;

use App\Factories\TaskRepositoryFactory;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TaskInterface;
use App\services\ResponseSuccessOrFail;
use App\Services\TaskValidator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected TaskValidator $task_validator,
        protected ResponseSuccessOrFail $response,
        // انا بستخدم ال factory
        protected TaskInterface $task_interface
        // انا بستخدم ال repositary
        // protected TaskInterface $task_interface
    ) {
        $this->task_interface = TaskRepositoryFactory::make();
    }


    public function index()
    {
        $tasks = $this->task_interface->getAllTask();

        if (!$tasks) {
            return response()->json([
                "status" => 404,
                "message" => "Empty Task!"
            ]);
        }

        return $this->response->responseSucessOrfailAndData(200, "success", $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->task_validator->TaskValidator($request);
        if ($validator) {
            return $validator;
        }

        $this->task_interface->create($request->all());

        return $this->response->responseSucessOrfail(200, "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = $this->task_interface->findByID($id);

        if (!$task) {
            return $this->response->responseSucessOrfail(404, "Not Found!");
        }

        return $this->response->responseSucessOrfailAndData(200, "success", $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = $this->task_interface->update($id, $request->all());

        if (!$task) {
            return $this->response->responseSucessOrfail(404, "Not Found!");
        }

        $validator = $this->task_validator->TaskValidator($request);
        if ($validator) {
            return $validator;
        }

        return $this->response->responseSucessOrfail(200, "success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = $this->task_interface->findByID($id);

        if (!$task) {
            return $this->response->responseSucessOrfail(404, "Not Found!");
        }

        $task->delete();

        return $this->response->responseSucessOrfail(200, "success");
    }


    public function forceDeletedTask(string $id)
    {
        $task = $this->task_interface->findByID($id);

        if (!$task) {
            return $this->response->responseSucessOrfail(404, "Not Found!");
        }

        $task->forceDelete();

        return $this->response->responseSucessOrfail(200, "success");
    }

    public function restoreTask(string $id)
    {
        $task = $this->task_interface->restoreTask($id);

        if (!$task || !$task->trashed()) {
            return response()->json([
                'status' => 404,
                'message' => "No deleted task with this ID"
            ]);
        }

        $task->restore();

        return $this->response->responseSucessOrfailAndData(200, "success", $task);
    }
}
