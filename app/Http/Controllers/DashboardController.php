<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;
use App\Models\Tasks;

class DashboardController extends Controller
{
    public function __construct(){}

    /**
    * Show dashboard page with lists and tasks
    */
    public function index()
    {
    	$lists = Lists::with('Tasks')->get();
    	return view('dashboard')->with(['lists' => $lists]);
    }
}
