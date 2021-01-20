<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Lists;
use App\Models\User;

class ListsController extends Controller
{
    /**
    * Integer of the user ID
    */
    private $userId;

    public function __construct(Request $request){
        $this->userId = ($request->user()) ? $request->user()->id : User::where('password', Cookie::get('guest_account'))->where('guest', 1)->first()->id;
    }

    /**
    * Store resource in database
    */
    public function store(Request $request)
    {
    	$request->validate([
            'list' => ['required', 'string', 'max:255']
        ]);

        $list = new Lists;

        $list->name 	= $request->list;
        $list->users_id = $this->userId;

        $list->save();

        User::where('id', $this->userId)
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

        User::where('id', $this->userId)
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

        User::where('id', $this->userId)
            ->update(['last_activity' => date('Y-m-d')]);

        return redirect('/dashboard');
    }
}
