<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'email',
        'mobile',
        'gender',
        'age',
        'birth_date',
        'height_in_inches',
        'weight',
        'current_status',
        'reference',
        'medical_conditions',
        'status',
    ];
}
