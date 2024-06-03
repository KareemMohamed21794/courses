<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class AdminAuthenticatedSessionController extends Controller
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

        return view('auth.admin.login');
    }

    public function create_new()
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

        $arrCountries = Country::all();
         

        return view('auth.admin.login_new',compact('arrCountries'));
    }


    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminLoginRequest $request)
    {  

        
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
