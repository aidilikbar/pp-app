<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date_of_birth', 'gender', 'contact_number', 'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function healthRecords()
    {
        return $this->hasMany(PpHealthRecord::class);
    }

    public function appointments()
    {
        return $this->hasMany(PpAppointment::class);
    }
}
