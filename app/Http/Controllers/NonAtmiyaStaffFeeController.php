<?php

namespace App\Http\Controllers;

use App\Models\NonAtmiyaStaffFee;
use Illuminate\Http\Request;

class NonAtmiyaStaffFeeController extends Controller
{
    public function index()
    {
        $title = 'Fees - Non Atmiya Staff';
        $fees = NonAtmiyaStaffFee::all();
        return view('admin.fees-non-atmiya.index', compact('title', 'fees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'membership_duration' => 'required|string|max:255',
            'fees_amount' => 'required|numeric',
        ]);

        NonAtmiyaStaffFee::create($validatedData);

        return redirect()->route('fees.non-atmiya')->with('success', 'Fees data has been added successfully!');
    }

    public function edit($id)
    {
        $fee = NonAtmiyaStaffFee::findOrFail($id);
        $title = 'Edit Fees - Non Atmiya Staff';
        return view('admin.fees-non-atmiya.edit', compact('title', 'fee'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'membership_duration' => 'required|string|max:255',
            'fees_amount' => 'required|numeric',
        ]);

        $fee = NonAtmiyaStaffFee::findOrFail($id);
        $fee->update($validatedData);

        return redirect()->route('fees.non-atmiya')->with('success', 'Fees data has been updated successfully!');
    }

    public function destroy($id)
    {
        $fee = NonAtmiyaStaffFee::findOrFail($id);
        $fee->delete();

        return redirect()->route('fees.non-atmiya')->with('success', 'Fees data has been deleted successfully!');
    }
}
