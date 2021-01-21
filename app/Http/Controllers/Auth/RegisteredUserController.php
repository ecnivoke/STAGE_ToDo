<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lists;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        // Neem alle lijsten en taken mee naar het nieuwe account.
        // En verwijder het gast account
        if($cookie = Cookie::get('guest_account')){
            $previousId = User::where('guest_token', $cookie)->first()->id;
            Lists::where('users_id', $previousId)
                ->update(['users_id' => $user->id]);
            User::destroy($previousId);
            Cookie::queue('guest_account', '', 2628000);
        }

        if( $request->session()->has('userId'))
            $request->session()->put('userId', $user->id);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
