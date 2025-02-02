<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view("admin.auth.login");
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')
            ->withInput() 
            ->withErrors(['email' => 'Oops! You have entered invalid credentials']);
    }


    public function registration()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.registration');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('admin.login')->with('success', 'Registration successful');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function dashboard()
    {
        $title = "Dashboard";
        $totalMembers = Member::count();
        $currentDate = Carbon::now();
        $oneWeekFromNow = $currentDate->copy()->addDays(7);
        $upcomingReneableCount = Member::whereBetween('end_date', [$currentDate->toDateString(), $oneWeekFromNow->toDateString()])
            ->count();
        return view('admin.index', compact('totalMembers', 'upcomingReneableCount', 'title'));
    }
    

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('/');
    }
}
