<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpHealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'description', 'record_type',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
