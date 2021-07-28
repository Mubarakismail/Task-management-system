<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'task_title'=>'required',
            'task_desc'=>'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $task=Task::create([
            'task_title'=>$request->task_title,
            'task_desc'=>$request->task_desc,
            'start_date'=>$request->start_time,
            'end_date'=>$request->end_time,
        ]);
        if (isset($request->developers_mention)&&!empty($request->developers_mention)) {
            $task->Users()->sync($request->developers_mention);
        }
        return redirect()->route('task_show');
    }
}
