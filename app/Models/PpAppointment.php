<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'healthcare_professional_id', 'appointment_date', 'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function healthcareProfessional()
    {
        return $this->belongsTo(User::class, 'healthcare_professional_id');
    }
}
