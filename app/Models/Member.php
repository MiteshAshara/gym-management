<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_no',
        'fees',
        'payment_mode',
        'joining_date',
        'end_date',
        'image',
        'membership_duration',
        'category',
        'age',
        'birth_date',
        'height_in_inches',
        'weight',
        'current_status',
        'reference',
        'medical_conditions',
        'gender',
    ];
}
