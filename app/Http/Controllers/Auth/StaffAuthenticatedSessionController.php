<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StaffLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }

        if (Auth::guard('client')->check()) {
            return redirect('/client');
        }

        if (Auth::guard('staff')->check()) {
            return redirect('staff');
        }

        return view('auth.admin.staff_login');
    }


    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StaffLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
		
		  $id=$request->user('staff')->id;
		

        return redirect()->intended('/staff/staff/'.$id);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('staff')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/staff/login');
    }
}
