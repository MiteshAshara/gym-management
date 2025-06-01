<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AtmiyaStaffFee;
use App\Models\NonAtmiyaStaffFee;

class ReneableController extends Controller
{
    public function index()
    {
        $title = 'Upcoming Renewable';
        $currentDate = \Carbon\Carbon::now()->startOfDay();
        $endOfToday = \Carbon\Carbon::now()->endOfDay();
        $oneWeekFromNow = $currentDate->copy()->addDays(7);
        
        // Get all members regardless of renewal date
        $members = Member::orderBy('end_date', 'asc')->get();
        
        // Fixed count for today's renewals - using a more precise date range
        $todayRenewals = Member::whereBetween('end_date', [
            $currentDate->toDateString()." 00:00:00", 
            $currentDate->toDateString()." 23:59:59"
        ])->count();
        
        $thisWeekRenewals = Member::whereBetween('end_date', [
            $currentDate->toDateString(),
            $currentDate->copy()->addDays(7)->toDateString()
        ])->count();
        
        $thisMonthRenewals = Member::whereBetween('end_date', [
            $currentDate->toDateString(),
            $currentDate->copy()->endOfMonth()->toDateString()
        ])->count();
        
        $totalRenewals = Member::count();
        
        return view('admin.reneable.index', compact(
            'members', 
            'title',
            'todayRenewals',
            'thisWeekRenewals',
            'thisMonthRenewals',
            'totalRenewals'
        ));
    }

    public function edit($id)
    {
        $title = "Renewable Members";
        $member = Member::findOrFail($id);
        $fees = Fees::all();
        $atmiyaStaffFees = AtmiyaStaffFee::all();
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all();

        return view('admin.reneable.edit', compact('member', 'fees', 'atmiyaStaffFees', 'nonAtmiyaStaffFees', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:10',
            'membership_duration' => 'required|string',
            'payment_mode' => 'required|string',
            'joining_date' => 'required|date',
            'renewal_date' => 'required|date', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8048'
        ]);

        $member = Member::findOrFail($id);
        $member->name = $request->name;
        $member->contact_no = $request->contact_no;
        $member->membership_duration = $request->membership_duration;
        $member->payment_mode = $request->payment_mode;
        $member->joining_date = $request->joining_date;

        $member->end_date = $request->renewal_date;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('members', $imageName, 'public');
            $member->image = $imagePath;
        }

        $member->save();

        return redirect()->route('admin.reneable.index')->with('success', 'Member renewed successfully with updated end date.');
    }
}
