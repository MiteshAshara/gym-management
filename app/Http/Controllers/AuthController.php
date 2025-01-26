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
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user with the provided credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // If authentication is successful, redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If authentication fails, redirect back to the login page with an error message
        return redirect()->route('admin.login')
            ->withInput() // Keeps the email value input
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
        $title="Dashbaord";
        // Total members count
        $totalMembers = Member::count();

        // Count of "Upcoming Reneable" members (end_date is this month or today)
        $currentDate = Carbon::now();
        $upcomingReneableCount = Member::whereMonth('end_date', $currentDate->month)
            ->orWhereDate('end_date', $currentDate->toDateString())
            ->count();

        // Return view with both counts
        return view('admin.index', compact('totalMembers', 'upcomingReneableCount','title'));
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
