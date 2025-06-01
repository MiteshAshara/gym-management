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
            'birth_date' => 'nullable|date', // Changed to nullable
            'height_in_inches' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'current_status' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
            'medical_conditions' => 'nullable|string', // Fix validation rule
            'status' => 'nullable|in:hot,cold,pending',
        ]);

        // Create data with defaults for missing required fields
        $data = $request->all();
        
        // Set default birth_date if not provided
        if (!isset($data['birth_date']) || empty($data['birth_date'])) {
            $data['birth_date'] = date('Y-m-d');
        }
        
        // Set default status if not provided
        if (!isset($data['status']) || empty($data['status'])) {
            $data['status'] = 'pending';
        }
        
        // Set default current_status if not provided
        if (!isset($data['current_status']) || empty($data['current_status'])) {
            $data['current_status'] = 'other';
        }

        Inquiry::create($data);
        
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
            'birth_date' => 'required|date', // Changed to required
            'height_in_inches' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'current_status' => 'required|string|max:255', // Added validation
            'reference' => 'nullable|string|max:255', // Added validation
            'medical_conditions' => 'nullable|string', // Added validation
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

    /**
     * Change inquiry status to any status
     */
    public function changeStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:hot,cold,pending',
        ]);
        
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $request->status;
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
