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

    public function recover($id)
    {
        $recoveryMember = RecoveryMember::findOrFail($id);
        $newImagePath = null;

        // Check if the image exists
        if ($recoveryMember->image && file_exists(public_path($recoveryMember->image))) {
            $originalImageName = basename($recoveryMember->image);
            $newImageDir = 'images/members/';
            $newImagePath = $newImageDir . $originalImageName;

            $sourcePath = public_path($recoveryMember->image);
            $destinationPath = public_path($newImagePath);

            // Create the members directory if it doesn't exist
            if (!file_exists(public_path($newImageDir))) {
                mkdir(public_path($newImageDir), 0777, true);
            }

            // Move image from recovery-member to members
            if (rename($sourcePath, $destinationPath)) {
                // Success, image moved and path updated
            } else {
                // In case rename fails, fallback to null
                $newImagePath = null;
            }
        }

        // Create a new Member record
        Member::create([
            'name' => $recoveryMember->name,
            'contact_no' => $recoveryMember->contact_no,
            'fees' => $recoveryMember->fees,
            'payment_mode' => $recoveryMember->payment_mode,
            'joining_date' => $recoveryMember->joining_date,
            'end_date' => $recoveryMember->end_date,
            'image' => $newImagePath,
            'membership_duration' => $recoveryMember->membership_duration,
            'category' => $recoveryMember->category,
        ]);

        // Delete the record from recovery table
        $recoveryMember->delete();

        return redirect()->route('recovery.member')->with('success', 'Member successfully recovered!');
    }

}
