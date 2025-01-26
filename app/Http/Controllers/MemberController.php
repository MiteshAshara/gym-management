<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Member;
use App\Models\RecoveryMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function create()
    {
        $title='Members';
        $members = Member::all();
        $fees = Fees::all(); // Assuming Fee model contains membership durations and fees.
        return view('admin.members.member', compact('fees', 'members','title'));
    }

    // Store the data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15|regex:/^\d{10}$/',
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:50',
            'fees' => 'required|string',
            'payment_mode' => 'required|string|max:50',
            'joining_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:joining_date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
            'membership_duration' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Generate the image name with the member's name
            $imageName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('members', $imageName, 'public');
        }

        Member::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'department' => $request->department,
            'semester' => $request->semester,
            'fees' => $request->fees,
            'payment_mode' => $request->payment_mode,
            'joining_date' => $request->joining_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'membership_duration' => $request->membership_duration,
        ]);

        return redirect()->route('member')->with('success', 'Member added successfully.');
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $fees = Fees::all();
        return view('admin.members.edit', compact('member', 'fees'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15|regex:/^\d{10}$/',
            'department' => 'required|string|max:255',
            'semester' => 'required|string|max:50',
            'payment_mode' => 'required|string|max:50',
            'joining_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:joining_date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
            'membership_duration' => 'required|string',
        ]);

        $imagePath = $member->image; // Default image path (if not changed)
        if ($request->hasFile('image')) {
            // If a new image is uploaded, delete the old image
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            // Generate the image name with the member's name
            $imageName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('members', $imageName, 'public');
        }

        // Update the member record with the new data
        $member->update([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'department' => $request->department,
            'semester' => $request->semester,
            'fees' => $request->fees,
            'payment_mode' => $request->payment_mode,
            'joining_date' => $request->joining_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'membership_duration' => $request->membership_duration, // Ensure this is updated
        ]);

        return redirect()->route('member', $id)->with('success', 'Member updated successfully.');
    }



    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // Save the member data into the recovery_members table before deletion
        $imagePath = null;
        if ($member->image) {
            // Move the image to the recovery-members folder
            $newImagePath = 'recovery-members/' . basename($member->image);
            Storage::disk('public')->move($member->image, $newImagePath);
            $imagePath = $newImagePath;
        }

        // Create a record in the recovery_members table
        RecoveryMember::create([
            'name' => $member->name,
            'image' => $imagePath,
            'contact_no' => $member->contact_no,
            'membership_duration' => $member->membership_duration,
            'fees' => $member->fees,
            'department' => $member->department,
            'semester' => $member->semester,
            'payment_mode' => $member->payment_mode,
            'joining_date' => $member->joining_date,
            'end_date' => $member->end_date,
        ]);

        // Delete the member record
        $member->delete();

        return redirect()->route('member')->with('success', 'Member deleted and moved to recovery successfully!');
    }
}
