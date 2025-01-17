@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<h1 class="h4 mb-3">Edit Appointment</h1>

<form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select name="patient_id" id="patient_id" class="form-select" required>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                    {{ $patient->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="healthcare_professional_id" class="form-label">Healthcare Professional</label>
        <select name="healthcare_professional_id" id="healthcare_professional_id" class="form-select" required>
            @foreach ($healthcareProfessionals as $hcp)
                <option value="{{ $hcp->id }}" {{ $appointment->healthcare_professional_id == $hcp->id ? 'selected' : '' }}>
                    {{ $hcp->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="appointment_date" class="form-label">Date</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" value="{{ $appointment->appointment_date }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection