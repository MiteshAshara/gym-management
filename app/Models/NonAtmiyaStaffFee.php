<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonAtmiyaStaffFee extends Model
{
    use HasFactory;

    protected $fillable = ['membership_duration', 'fees_amount'];
}
