<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtmiyaStaffFee extends Model
{
    use HasFactory;

    protected $table = 'atmiya_staff_fees'; 

    protected $fillable = [
        'membership_duration',
        'fees_amount'
    ];
}
