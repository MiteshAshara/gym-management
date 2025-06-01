<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\AtmiyaStaffFee;
use App\Models\NonAtmiyaStaffFee;
use Illuminate\Http\Request;

class FeesStructureController extends Controller
{
    public function index()
    {
        $title = 'Fees Structure';
        // Make sure to define all fee variables needed by the view
        $fees = Fees::all();
        $atmiya_staff_fees = AtmiyaStaffFee::all();
        $non_atmiya_staff_fees = NonAtmiyaStaffFee::all();
        
        return view('admin.fees.structure', compact('title', 'fees', 'atmiya_staff_fees', 'non_atmiya_staff_fees'));
    }
}
