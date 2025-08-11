<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Returns all the tasks.
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse {
        return response()->json(Task::with('completions')->orderByDesc('id')->get());
    }

    /**
     * Returns the task by ID.
     *
     * @param Task $task - Task wildcard.
     * @return JsonResponse
     */
    public function findById(Task $task): JsonResponse {
        if (!$task) {
            return response()->setStatusCode(404)->json('Not found');
        }

        return response()->json($task);
    }

    /**
     * Deletes the task by ID.
     *
     * @param Task $task - Task wildcard.
     * @return JsonResponse
     */
    public function delete(Task $task): JsonResponse {
        try {
            return response()->json($task->delete());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Updates the task.
     *
     * @param Task $task - Task wildcard.
     * @return JsonResponse
     */
    public function update(Task $task): JsonResponse {
        if (!$task) {
            return response()->setStatusCode(404)->json('Not found');
        }

        try {
            return response()->json($task->update(request()->all()));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Creates a task.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse {
        $task = new Task();
        $task->setAttribute('title', request()->get('title'));
        $task->setAttribute('frequency', request()->get('frequency'));

        try {
            $task->save();

            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
