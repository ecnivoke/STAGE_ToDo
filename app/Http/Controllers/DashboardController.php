<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;

use App\Models\Lists;
use App\Models\Tasks;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct(Request $request, Redirector $redirect)
    {
		if(!$request->user() && !Cookie::get('guest_account')){
			$pass = Crypt::encryptString(Str::random(32));
			Cookie::queue('guest_account', $pass, 2628000);
			User::create([
				'name' => 'Guest'.time(),
				'guest' => 1,
				'password' => $pass
			]);
		}
	}

    /**
    * Show dashboard page with lists and tasks
    */
    public function index(Request $request)
    {
    	// deze if is raar, want de eerste keer als je hier komt doet de cookie het niet.
    	// terwijl die het wel zou moeten doen
    	// na de 2e keer, dus na een redirect, doet ie het wel.
    	if(!$request->user() && !Cookie::get('guest_account')){
    		return redirect('/dashboard');
    	}

    	$id = ($request->user()) 
    		? $request->user()->id 
    		: User::where('password', Cookie::get('guest_account'))
    			->where('guest', 1)
    			->first()->id;

    	$lists = Lists::with('Tasks')->where('users_id', $id)->get();
    	return view('dashboard')->with(['lists' => $lists]);
    }
}
