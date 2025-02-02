<?php

namespace App\Http\Controllers;
use App\Models\AtmiyaStaffFee;
use App\Models\Fees;
use App\Models\NonAtmiyaStaffFee;
use Illuminate\Http\Request;

class FeesStructureController extends Controller
{
    public function index()
    {
        $student = Fees::all();
        $atmiyaStaffFees = AtmiyaStaffFee::all();
        $nonAtmiyaStaffFees = NonAtmiyaStaffFee::all();
        return view('admin.fees.structure', compact('atmiyaStaffFees', 'nonAtmiyaStaffFees', 'student'));
    }
}
