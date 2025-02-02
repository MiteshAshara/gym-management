<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Fees;
use App\Models\AtmiyaStaffFee;
use App\Models\NonAtmiyaStaffFee;
use App\Models\Member;
use App\Models\RecoveryMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function exportPDF()
    {
        $members = Member::all();

        $pdf = Pdf::loadView('admin.members.pdf', compact('members'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('members-list.pdf');
    }

    public function create()
    {
        $title = 'Members';
        $members = Member::all();
        $fees = Fees::all(); 
        $atmiyaStaffFees = AtmiyaStaffFee::all(); 
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all(); 

        return view('admin.members.member', compact('fees', 'atmiyaStaffFees', 'nonAtmiyaStaffFees', 'members', 'title'));
    }

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
            'category' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
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
            'category' => $request->category,
        ]);

        return redirect()->route('member')->with('success', 'Member added successfully.');
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $fees = Fees::all(); 
        $atmiyaStaffFees = AtmiyaStaffFee::all();
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all();

        return view('admin.members.edit', compact('member', 'fees', 'atmiyaStaffFees', 'nonAtmiyaStaffFees'));
    }


    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

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

        
        $imagePath = $member->image;
        if ($request->hasFile('image')) {
            
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            
            $imageName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('members', $imageName, 'public');
        }

        
        $fees = null;
        if ($request->category == 'atmiya_student') {
            $fees = Fees::where('membership_duration', $request->membership_duration)->value('fees_amount');
        } elseif ($request->category == 'atmiya_staff') {
            $fees = AtmiyaStaffFee::where('membership_duration', $request->membership_duration)->value('fees_amount');
        } elseif ($request->category == 'non_atmiya_staff') {
            $fees = NonAtmiyaStaffFee::where('membership_duration', $request->membership_duration)->value('fees_amount');
        }

        
        $fees = $fees ?? $member->fees;

        
        $member->update([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'department' => $request->department,
            'semester' => $request->semester,
            'fees' => $fees,
            'payment_mode' => $request->payment_mode,
            'joining_date' => $request->joining_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'membership_duration' => $request->membership_duration,
            'category' => $request->category,
        ]);

        return redirect()->route('member')->with('success', 'Member updated successfully.');
    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        $imagePath = null;
        if ($member->image) {

            $newImagePath = 'recovery-members/' . basename($member->image);
            Storage::disk('public')->move($member->image, $newImagePath);
            $imagePath = $newImagePath;
        }

        RecoveryMember::create([
            'name' => $member->name,
            'image' => $imagePath,
            'contact_no' => $member->contact_no,
            'membership_duration' => $member->membership_duration,
            'fees' => $member->fees,
            'category'=>$member->category,
            'department' => $member->department,
            'semester' => $member->semester,
            'payment_mode' => $member->payment_mode,
            'joining_date' => $member->joining_date,
            'end_date' => $member->end_date,
        ]);

        $member->delete();

        return redirect()->route('member')->with('success', 'Member deleted and moved to recovery successfully!');
    }
}
