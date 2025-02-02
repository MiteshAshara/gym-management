<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoveryMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'membership_duration',
        'category',
        'contact_no',
        'department',
        'fees',
        'semester',
        'payment_mode',
        'joining_date',
        'end_date',
    ];
}
