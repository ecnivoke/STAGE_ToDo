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

        return redirect('/dashboard');
    }
}
