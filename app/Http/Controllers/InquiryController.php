<?php
namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $title = 'Inquiry';
        $inquiries = Inquiry::all();
        return view('admin.inquiries.index', compact('inquiries','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:inquiries,email',
            'mobile' => 'required|string|max:15|unique:inquiries,mobile',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:1',
            'height_in_inches' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'status' => 'required|in:hot,cold,pending',
        ]);

        Inquiry::create($request->all());
        return redirect()->route('inquiries')->with('success', 'Inquiry created successfully.');
    }

    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $title = 'Edit Inquiry';
        return view('admin.inquiries.edit', compact('inquiry', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:inquiries,email,' . $id,
            'mobile' => 'required|string|max:15|unique:inquiries,mobile,' . $id,
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:1',
            'height_in_inches' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'status' => 'required|in:hot,cold,pending',
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update($request->all());

        return redirect()->route('inquiries')->with('success', 'Inquiry updated successfully.');
    }

    public function confirm($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = 'hot'; // Update the status to 'hot' or any other desired value
        $inquiry->save();

        return redirect()->route('inquiries')->with('success', 'Inquiry confirmed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Inquiry deleted successfully']);
        }
        
        return redirect()->route('inquiries')->with('success', 'Inquiry deleted successfully');
    }

    /**
     * Toggle inquiry cold/pending status
     */
    public function toggleCold($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        
        // Toggle status between cold and pending
        $inquiry->status = ($inquiry->status === 'cold') ? 'pending' : 'cold';
        $inquiry->save();
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true, 
                'message' => 'Status updated successfully', 
                'status' => $inquiry->status
            ]);
        }
        
        return redirect()->route('inquiries')->with('success', 'Inquiry status updated successfully');
    }
}
