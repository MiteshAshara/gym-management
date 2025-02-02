<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;  // Add this import

class ReneableController extends Controller
{
    public function index()
    {
        $title = "Upcoming Renewable Members";

        $today = now();
        $sevenDaysLater = now()->addDays(7);

        $members = Member::whereBetween('end_date', [$today, $sevenDaysLater])
            ->orderBy('end_date')
            ->get();

        return view('admin.reneable.index', compact('title', 'members'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:10',
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'membership_duration' => 'required|string',
            'payment_mode' => 'required|string',
            'joining_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $member = Member::find($id);
        $member->name = $request->name;
        $member->contact_no = $request->contact_no;
        $member->department = $request->department;
        $member->semester = $request->semester;
        $member->membership_duration = $request->membership_duration;
        $member->payment_mode = $request->payment_mode;
        $member->joining_date = $request->joining_date;
        $member->end_date = $this->calculateEndDate($request->joining_date, $request->membership_duration);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension(); 
            $imagePath = $image->storeAs('members', $imageName, 'public'); 
            $member->image = $imagePath;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }


    private function calculateEndDate($joiningDate, $membershipDuration)
    {
        $joiningDate = Carbon::parse($joiningDate);

        if ($membershipDuration == '3 months') {
            return $joiningDate->addMonths(3)->format('Y-m-d');
        } elseif ($membershipDuration == '6 months') {
            return $joiningDate->addMonths(6)->format('Y-m-d');
        } elseif ($membershipDuration == '1 year') {
            return $joiningDate->addYear()->format('Y-m-d');
        }

        return $joiningDate;
    }
}
