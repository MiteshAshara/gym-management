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
        $request->validate([
            'membership_duration' => 'required',
            'fees_amount' => 'required|numeric|min:0',
        ]);

        Fees::create([
            'membership_duration' => $request->membership_duration,
            'fees_amount' => $request->fees_amount,
        ]);

        return redirect()->back()->with('success', 'Fee added successfully');
    }
    public function edit($id)
    {
        $title='Edit Fees';
        $fee = Fees::findOrFail($id);
        return view('admin.fees.edit', compact('fee','title'));
    }
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
    public function destroy($id)
    {
        $fee = Fees::findOrFail($id);
        $fee->delete();

        return redirect()->route('fees')->with('success', 'Fee deleted successfully!');
    }

}
