<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    // Specify the custom table name
    protected $table = 'pp_health_records';

    protected $fillable = [
        'patient_id',
        'description',
        'record_type',
    ];

    // Define the relationship to the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
