@extends('layouts.app')

@section('title', 'Create Health Record')

@section('content')
<h1 class="h4 mb-3">Create Health Record</h1>

<form action="{{ route('health-records.store') }}" method="POST" class="mb-4">
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
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="record_type" class="form-label">Type</label>
        <select name="record_type" id="record_type" class="form-select" required>
            <option value="">Select Type</option>
            <option value="diagnosis">Diagnosis</option>
            <option value="medication">Medication</option>
            <option value="allergy">Allergy</option>
            <option value="test_result">Test Result</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection