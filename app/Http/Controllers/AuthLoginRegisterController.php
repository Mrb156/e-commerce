<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthLoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', '/'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc, dns', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role' => 1
        ]);
        Order::create([
            'user_id' => $user->id,
            'price' => 0,
            'item_count' => 0,
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                if (Auth::user()->role == 1) {

                    return redirect()->route('home')
                        ->withSuccess('You have successfully logged in!');
                } elseif (Auth::user()->role == 0) {
                    return redirect()->route('admin.dashboard');
                }
            }
        }

        return back()->withInput();
    }


    public function login()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            if (Auth::user()->role == 1) {

                return redirect()->route('home')
                    ->withSuccess('You have successfully logged in!');
            } elseif (Auth::user()->role == 0) {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Helytelen bejelentkezési adatok',]);
    }

    /**
     * Log out the user from application.
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')
            ->withSuccess('You have logged out successfully!');
    }
}
