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
        'fees',
        'payment_mode',
        'joining_date',
        'end_date',
        'age',
        'birth_date',
        'height_in_inches',
        'weight',
        'current_status',
        'reference',
        'medical_conditions',
        'gender', // Added gender to fillable array
    ];
}
