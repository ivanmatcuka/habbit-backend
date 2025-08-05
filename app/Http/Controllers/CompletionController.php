<?php

namespace App\Http\Controllers;

use App\Models\Completion;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompletionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Task $task - Task wildcard.
     * @return JsonResponse
     */
    public function store(Task $task): JsonResponse
    {
        if (!$task) {
            return response()->setStatusCode(404)->json('Not found');
        }

        $task->completions()->create([
            'completed_at' => request()->get('completed_at'),
            'task_id' => $task->getAttribute('id'),
        ]);

        return response()->json(Task::with('completions')->find($task->getAttribute('id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Completion $completion - Completion wildcard.
     * @return JsonResponse
     */
    public function delete(Completion $completion): JsonResponse
    {
        if (!$completion) {
            return response()->setStatusCode(404)->json('Not found');
        }

        try {
            return response()->json($completion->delete());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
