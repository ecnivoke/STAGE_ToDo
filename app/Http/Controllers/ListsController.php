<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Lists;
use App\Models\User;

class ListsController extends Controller
{
    public function __construct(){}

    /**
    * Store resource in database
    */
    public function store(Request $request)
    {
    	$request->validate([
            'list' => ['required', 'string', 'max:255']
        ]);

        $id = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;

        $list = new Lists;

        $list->name 	= $request->list;
        $list->users_id = $id;

        $list->save();

        User::where('id', $id)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }

    /**
    * Update resource in database
    */
    public function update(Request $request)
    {
        $request->validate([
            'list' => ['required', 'string', 'max:255'],
            'list_id' => ['required', 'integer']
        ]);

        Lists::where('id', $request->list_id)
            ->update(['name' => $request->list]);

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
            'list_id' => ['required', 'integer']
        ]);

        Lists::destroy($request->list_id);

        $userId = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;
        
        User::where('id', $userId)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }
}
