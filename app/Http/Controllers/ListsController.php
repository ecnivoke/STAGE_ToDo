<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;

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

        $list = new Lists;

        $list->name 	= $request->list;
        $list->users_id = $request->user()->id;

        $list->save();

        return redirect('/dashboard');
    }
}
