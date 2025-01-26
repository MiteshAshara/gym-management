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
        $title='Renewable';
        // Get the current date
        $currentDate = Carbon::now();

        // Filter members whose end_date is in the current month or today's date
        $members = Member::whereMonth('end_date', $currentDate->month)
            ->orWhereDate('end_date', $currentDate->toDateString())
            ->get();

        return view('admin.reneable.index', compact('members','title'));
    }

    public function update(Request $request, $id)
    {
        // Validate inputs
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

        // Handle the image upload and rename it with the user's name
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension(); // Use member's name for image file
            $imagePath = $image->storeAs('members', $imageName, 'public'); // Store image with new name
            $member->image = $imagePath;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }


    private function calculateEndDate($joiningDate, $membershipDuration)
    {
        $joiningDate = Carbon::parse($joiningDate);

        // Calculate end date based on the membership duration
        if ($membershipDuration == '3 months') {
            return $joiningDate->addMonths(3)->format('Y-m-d');
        } elseif ($membershipDuration == '6 months') {
            return $joiningDate->addMonths(6)->format('Y-m-d');
        } elseif ($membershipDuration == '1 year') {
            return $joiningDate->addYear()->format('Y-m-d');
        }

        // Default return, if no matching duration
        return $joiningDate;
    }
}
