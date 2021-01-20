<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Tasks;
use App\Models\User;

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

        $userId = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;
        
        User::where('id', $userId)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }

    /**
    * Update resource in database
    */
    public function update(Request $request)
    {
        $request->validate([
            'task' => ['required', 'string', 'max:255'],
            'task_id' => ['required', 'integer']
        ]);

        Tasks::where('id', $request->task_id)
            ->update(['text' => $request->task]);

        $userId = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;
        
        User::where('id', $userId)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }

    /**
    * Delete resource in database
    */
    public function destroy(Request $request)
    {
        $request->validate([
            'task_id' => ['required', 'integer']
        ]);

        Tasks::destroy($request->task_id);

        $userId = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;
        
        User::where('id', $userId)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }
}
