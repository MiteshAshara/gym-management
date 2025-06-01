<?php

namespace App\Http\Controllers;

use App\Models\AtmiyaStaffFee;
use Illuminate\Http\Request;

class FeestaffController extends Controller
{
    public function index()
    {
        $title = 'Fees';

        $fees = AtmiyaStaffFee::all();
        return view('admin.fees-staff.index', compact('title', 'fees'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'membership_duration' => 'required|string|max:255',
            'fees_amount' => 'required|numeric',
        ]);


        AtmiyaStaffFee::create($validatedData);


        return redirect()->route('fees.staff')->with('success', 'Fees data has been added successfully!');
    }

    public function edit($id)
    {
        $fee = AtmiyaStaffFee::findOrFail($id);
        $title = 'Edit Fees';
        return view('admin.fees-staff.edit', compact('title', 'fee'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'membership_duration' => 'required|string|max:255',
            'fees_amount' => 'required|numeric',
        ]);


        $fee = AtmiyaStaffFee::findOrFail($id);
        $fee->update($validatedData);


        return redirect()->route('fees.staff')->with('success', 'Fees data has been updated successfully!');
    }

    public function destroy($id)
    {

        $fee = AtmiyaStaffFee::findOrFail($id);
        $fee->delete();


        return redirect()->route('fees.staff')->with('success', 'Fees data has been deleted successfully!');
    }
}
