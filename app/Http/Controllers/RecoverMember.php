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

        try {
            // Create a new Member record with all fields
            $memberData = [
                'name' => $recoveryMember->name,
                'contact_no' => $recoveryMember->contact_no,
                'fees' => $recoveryMember->fees,
                'payment_mode' => $recoveryMember->payment_mode,
                'joining_date' => $recoveryMember->joining_date,
                'end_date' => $recoveryMember->end_date,
                'image' => $newImagePath,
                'membership_duration' => $recoveryMember->membership_duration,
                'category' => $recoveryMember->category,
                'age' => $recoveryMember->age,
                'birth_date' => $recoveryMember->birth_date,
                'height_in_inches' => $recoveryMember->height_in_inches,
                'weight' => $recoveryMember->weight,
                'current_status' => $recoveryMember->current_status,
                'reference' => $recoveryMember->reference,
                'medical_conditions' => $recoveryMember->medical_conditions,
                'gender' => $recoveryMember->gender, // Added gender field
            ];
            
            $member = Member::create($memberData);
            
            // Only delete the recovery record if the member record was created successfully
            if ($member) {
                $recoveryMember->delete();
                return redirect()->route('recovery.member')->with('success', 'Member successfully recovered!');
            } else {
                return redirect()->route('recovery.member')->with('error', 'Failed to recover member.');
            }
        } catch (\Exception $e) {
            return redirect()->route('recovery.member')->with('error', 'Error recovering member: ' . $e->getMessage());
        }
    }

    /**
     * Fix missing gender for existing recovery members.
     */
    public function fixMissingData()
    {
        $members = RecoveryMember::whereNull('gender')->get();
        $updated = 0;
        
        foreach ($members as $member) {
            // Set gender based on category as fallback
            if (!$member->gender) {
                if ($member->category == 'atmiya_student') {
                    $member->gender = 'male';
                } elseif ($member->category == 'atmiya_staff') {
                    $member->gender = 'female';
                } else {
                    $member->gender = 'other';
                }
                $member->save();
                $updated++;
            }
        }
        
        return redirect()->route('recovery.member')->with('success', $updated . ' recovery members updated with gender data.');
    }

}
