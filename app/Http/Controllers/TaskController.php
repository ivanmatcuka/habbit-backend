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
    public function all(): JsonResponse
    {
        $tasks = Task::with('completions')->where('user_id', auth()->id())->orderByDesc('id')->get();
        return response()->json($tasks);
    }

    /**
     * Returns the task by ID.
     *
     * @param Task $task - Task wildcard.
     * @return JsonResponse
     */
    public function findById(Task $task): JsonResponse
    {
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
    public function delete(Task $task): JsonResponse
    {
        if (auth()->id() != $task->user_id) {
            return response()->setStatusCode(401)->json('Unauthorized');
        }

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
    public function update(Task $task): JsonResponse
    {
        if (auth()->id() != $task->user_id) {
            return response()->setStatusCode(401)->json('Unauthorized');
        }

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
    public function create(): JsonResponse
    {
        $task = new Task();
        $task->setAttribute('title', request()->get('title'));
        $task->setAttribute('frequency', request()->get('frequency'));
        $task->setAttribute('user_id', auth()->id());

        try {
            $task->save();

            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
