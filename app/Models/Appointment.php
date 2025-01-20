<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'pp_appointments'; // Define the table name if it's not the default

    protected $fillable = [
        'patient_id',
        'healthcare_professional_id',
        'appointment_date',
        'status',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function healthcareProfessional()
    {
        return $this->belongsTo(User::class, 'healthcare_professional_id');
    }
}