@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<h1 class="h4 mb-3">Create Appointment</h1>

<form action="{{ route('appointments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select name="patient_id" id="patient_id" class="form-select" required>
            <option value="">Select a Patient</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="healthcare_professional_id" class="form-label">Healthcare Professional</label>
        <select name="healthcare_professional_id" id="healthcare_professional_id" class="form-select" required>
            <option value="">Select a Healthcare Professional</option>
            @foreach ($healthcareProfessionals as $hcp)
                <option value="{{ $hcp->id }}">{{ $hcp->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="appointment_date" class="form-label">Date</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection