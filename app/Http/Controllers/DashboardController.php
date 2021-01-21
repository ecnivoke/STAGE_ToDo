<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

use App\Models\Lists;
use App\Models\Tasks;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
		if(!$request->user() && empty(Cookie::get('guest_account'))){
			$token = Hash::make(Str::random(8));
			Cookie::queue('guest_account', $token, 2628000);
			User::create([
				'name' => 'Guest'.time(),
				'guest_token' => $token
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
    	if(!$request->user() && empty(Cookie::get('guest_account'))){
    		return redirect('/dashboard');
    	}

        $userId = ($request->user()) 
            ? $request->user()->id 
            : User::where('guest_token', Cookie::get('guest_account'))
                ->first()->id;

        if(!$request->session()->has('userId'))
            $request->session()->put('userId', $userId);

    	$lists = Lists::with('Tasks')->where('users_id', $userId)->get();
    	return view('dashboard')->with(['lists' => $lists]);
    }
}
