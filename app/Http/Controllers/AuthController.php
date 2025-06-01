<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Inquiry; // Add this import
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
        $currentDate = Carbon::now();
        
        // Member counts
        $totalMembers = Member::count();
        $todayMembers = Member::whereDate('joining_date', $currentDate->toDateString())->count();
        $thisMonthMembers = Member::whereYear('joining_date', $currentDate->year)
            ->whereMonth('joining_date', $currentDate->month)
            ->count();
        $lastMonth = $currentDate->copy()->subMonth();
        $lastMonthMembers = Member::whereYear('joining_date', $lastMonth->year)
            ->whereMonth('joining_date', $lastMonth->month)
            ->count();
        $thisYearMembers = Member::whereYear('joining_date', $currentDate->year)->count();
        
        // Renewal counts
        $oneWeekFromNow = $currentDate->copy()->addDays(7);
        $upcomingReneableCount = Member::whereBetween('end_date', [$currentDate->toDateString(), $oneWeekFromNow->toDateString()])
            ->count();
        $todayRenewals = Member::whereDate('end_date', $currentDate->toDateString())->count();
        $thisMonthRenewals = Member::whereYear('end_date', $currentDate->year)
            ->whereMonth('end_date', $currentDate->month)
            ->count();
        $lastMonthRenewals = Member::whereYear('end_date', $lastMonth->year)
            ->whereMonth('end_date', $lastMonth->month)
            ->count();
        $thisYearRenewals = Member::whereYear('end_date', $currentDate->year)->count();
            
        // Add inquiry status counts
        $hotInquiries = Inquiry::where('status', 'hot')->count();
        $coldInquiries = Inquiry::where('status', 'cold')->count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();
        
        // Add time-based inquiry counts
        $todayInquiries = Inquiry::whereDate('created_at', $currentDate->toDateString())->count();
        $thisMonthInquiries = Inquiry::whereYear('created_at', $currentDate->year)
            ->whereMonth('created_at', $currentDate->month)
            ->count();
        $lastMonth = $currentDate->copy()->subMonth();
        $lastMonthInquiries = Inquiry::whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->count();
        $thisYearInquiries = Inquiry::whereYear('created_at', $currentDate->year)->count();
        
        return view('admin.index', compact(
            'totalMembers',
            'todayMembers',
            'thisMonthMembers', 
            'lastMonthMembers',
            'thisYearMembers',
            'upcomingReneableCount',
            'todayRenewals',
            'thisMonthRenewals',
            'lastMonthRenewals',
            'thisYearRenewals',
            'title',
            'hotInquiries',
            'coldInquiries',
            'pendingInquiries',
            'todayInquiries',
            'thisMonthInquiries',
            'lastMonthInquiries',
            'thisYearInquiries'
        ));
    }
    

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('/');
    }
}
