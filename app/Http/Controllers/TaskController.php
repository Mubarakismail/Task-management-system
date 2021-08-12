<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\store;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('frontend.leader.tasks.index', compact('tasks'));
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function edit($id, store $request)
    {
        $row = Task::findOrFail($request->id);
        $row->update([
            $row->task_title = $request->task_title,
            $row->task_desc = $request->task_desc,
            $row->start_time = $request->start_time,
            $row->end_time = $request->end_time,

        ]);
        if (isset($request->developers_mention) && !empty($request->developers_mention)) {
            $devlopers = explode('@', $request->developers_mention[0]);
            $IDs = [];
            for ($i = 1; $i < sizeof($devlopers); $i++) {
                array_push($IDs, User::where('name', $devlopers[$i])->first()->id);
            }
            $row->Users()->sync($IDs);
        }
        return redirect()->back();
    }
    public function store(store $request)
    {
        $task = Task::create([
            'task_title' => $request->task_title,
            'task_desc' => $request->task_desc,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        if (isset($request->developers_mention) && !empty($request->developers_mention)) {
            $devlopers = explode('@', $request->developers_mention[0]);
            $IDs = [];
            for ($i = 1; $i < sizeof($devlopers); $i++) {
                array_push($IDs, User::where('name', $devlopers[$i])->first()->id);
            }
            $task->Users()->sync($IDs);
        }
        return redirect()->back();
    }
}
