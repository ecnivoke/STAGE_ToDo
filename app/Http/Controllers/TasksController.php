<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tasks;

class TasksController extends Controller
{
    public function __construct(){}

    /**
    * Store resource in database
    */
    public function store(Request $request)
    {
    	$request->validate([
            'task' => ['required', 'string', 'max:255']
        ]);

        $task = new Tasks;

        $task->text 	= $request->task;
        $task->lists_id = $request->list_id;

        $task->save();

        return redirect('/dashboard');
    }
}
