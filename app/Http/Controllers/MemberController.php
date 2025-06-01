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

        foreach ($members as $member) {
            if ($member->image && file_exists(public_path($member->image))) {
                $path = public_path($member->image);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $member->imageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } else {
                $member->imageData = null;
            }
        }

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

            // Move file to public/images/members instead of storage
            $request->file('image')->move(public_path('images/members'), $imageName);

            // Save the relative path to the image
            $imagePath = 'images/members/' . $imageName;
        }

        Member::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
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
        $title = 'Edit Member';
        $member = Member::findOrFail($id);
        $fees = Fees::all();
        $atmiyaStaffFees = AtmiyaStaffFee::all();
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all();

        return view('admin.members.edit', compact('member', 'fees', 'atmiyaStaffFees', 'nonAtmiyaStaffFees', 'title'));
    }


    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15|regex:/^\d{10}$/',
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
            // Delete the old image if it exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $imageName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $request->image->extension();
            $newPath = 'images/members/' . $imageName;

            // Ensure directory exists
            if (!file_exists(public_path('images/members'))) {
                mkdir(public_path('images/members'), 0777, true);
            }

            // Move image to public/images/members
            $request->file('image')->move(public_path('images/members'), $imageName);

            $imagePath = $newPath;
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

        if ($member->image && file_exists(public_path($member->image))) {
            $sourcePath = public_path($member->image); // original image full path
            $imageName = basename($member->image); // image file name
            $newDir = 'images/recovery-member/';
            $destinationPath = public_path($newDir . $imageName); // new full path

            // Create destination directory if it doesn't exist
            if (!file_exists(public_path($newDir))) {
                mkdir(public_path($newDir), 0777, true);
            }

            // Move the image file
            if (rename($sourcePath, $destinationPath)) {
                $imagePath = $newDir . $imageName; // relative path to store in DB
            }
        }

        // Save data to RecoveryMember table
        RecoveryMember::create([
            'name' => $member->name,
            'image' => $imagePath,
            'contact_no' => $member->contact_no,
            'membership_duration' => $member->membership_duration,
            'fees' => $member->fees,
            'category' => $member->category,
            'payment_mode' => $member->payment_mode,
            'joining_date' => $member->joining_date,
            'end_date' => $member->end_date,
        ]);

        // Delete the member record from main table
        $member->delete();

        return redirect()->route('member')->with('success', 'Member deleted successfully!');
    }


    /**
     * Create a member form pre-populated with inquiry data
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function createFromInquiry($id)
    {
        $title = 'Add Member from Inquiry';
        $inquiry = \App\Models\Inquiry::findOrFail($id);
        
        // Load fees data
        $fees = Fees::all();
        $atmiyaStaffFees = AtmiyaStaffFee::all();
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all();
        
        // Get all members for reference
        $members = Member::all();
        
        // Pre-select appropriate category based on gender
        $suggestedCategory = $inquiry->gender == 'male' ? 'atmiya_student' : 
                           ($inquiry->gender == 'female' ? 'atmiya_staff' : 'non_atmiya_staff');
        
        // Set today as default joining date
        $today = now()->format('Y-m-d');
        
        // Pass the inquiry data to the view for pre-filling the form
        return view('admin.members.member', compact(
            'fees', 
            'atmiyaStaffFees', 
            'nonAtmiyaStaffFees', 
            'members', 
            'title', 
            'inquiry',
            'suggestedCategory',
            'today'
        ));
    }
}
