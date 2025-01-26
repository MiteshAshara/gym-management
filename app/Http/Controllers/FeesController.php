<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        $title='Fees';
        $fee = Fees::all();
        return view('admin.fees.index', compact('fee','title'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'membership_duration' => 'required',
            'fees_amount' => 'required|numeric|min:0',
        ]);

        // Store the fee data using the Fee model
        Fees::create([
            'membership_duration' => $request->membership_duration,
            'fees_amount' => $request->fees_amount,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Fee added successfully');
    }

    // Edit Fee Form
    public function edit($id)
    {
        $fee = Fees::findOrFail($id);
        return view('admin.fees.edit', compact('fee'));
    }

    // Update Fee
    public function update(Request $request, $id)
    {
        $request->validate([
            'membership_duration' => 'required',
            'fees_amount' => 'required|numeric|min:0',
        ]);

        $fee = Fees::findOrFail($id);
        $fee->membership_duration = $request->membership_duration;
        $fee->fees_amount = $request->fees_amount;
        $fee->save();

        return redirect()->route('fees')->with('success', 'Fee updated successfully!');
    }

    // Delete Fee
    public function destroy($id)
    {
        $fee = Fees::findOrFail($id);
        $fee->delete();

        return redirect()->route('fees')->with('success', 'Fee deleted successfully!');
    }

}
