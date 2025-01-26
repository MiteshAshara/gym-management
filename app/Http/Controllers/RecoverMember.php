<?php

namespace App\Http\Controllers;

use App\Models\RecoveryMember;
use Illuminate\Http\Request;

class RecoverMember extends Controller
{
    public function index()
    {
        $members = RecoveryMember::all();
        return view('admin.recovery-member.index', compact('members'));
    }
    public function recover($id)
    {
        // Retrieve the member from the recovery_members table
        $recoveryMember = RecoveryMember::findOrFail($id);

        // Move the image to the 'members' storage folder, if it exists
        $imagePath = $recoveryMember->image;
        if ($imagePath) {
            $imagePath = \Storage::disk('public')->move($imagePath, 'members/' . basename($imagePath));
        }

        // Insert the data into the members table
        $memberData = $recoveryMember->toArray();
        $memberData['image'] = $imagePath;

        // Import the Member model if it's not already imported
        \App\Models\Member::create($memberData);

        // Delete the record from the recovery_members table
        $recoveryMember->delete();

        // Redirect back with a success message
        return redirect()->route('admin.recovery-member.index')->with('success', 'Member recovered successfully!');
    }

}
