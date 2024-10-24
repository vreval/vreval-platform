<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Task::all();
    }

    public function show(Task $task): Task
    {
        return $task;
    }
}
