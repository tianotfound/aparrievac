<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evacuee extends Model
{
    use HasFactory;

    protected $fillable = [
        'evacsites_id',
        'last_name',
        'first_name',
        'middle_name',
        'contact_number',
        'age',
        'gender',
        'barangay',
        'address',
        'family_count',
        'medical_condition',
        'remarks',
    ];

    public function evacsites()
    {
        return $this->belongsTo(Evacsite::class);
    }

}
