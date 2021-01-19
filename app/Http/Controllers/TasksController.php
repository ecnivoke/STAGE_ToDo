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
}
