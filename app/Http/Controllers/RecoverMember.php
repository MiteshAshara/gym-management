<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\RecoveryMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecoverMember extends Controller
{
    public function index()
    {
        $title = 'Recover Member';
        $members = RecoveryMember::all();
        return view('admin.recovery-member.index', compact('members', 'title'));
    }

    public function recover($id, Request $request)
    {
        $recoveryMember = RecoveryMember::findOrFail($id);

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
            'category' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {

            $imageName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $request->image->extension();

            $imagePath = $request->file('image')->storeAs('members', $imageName, 'public');
        } else {

            $imagePath = $recoveryMember->image;
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
            'category' => $request->category,
        ]);

        $recoveryMember->delete();

        return redirect()->route('recovery.member')->with('success', 'Member Data Recovered.');
    }
}
