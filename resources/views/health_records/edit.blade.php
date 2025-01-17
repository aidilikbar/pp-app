@extends('layouts.app')

@section('title', 'Edit Health Record')

@section('content')
<h1 class="h4 mb-3">Edit Health Record</h1>

<form action="{{ route('health-records.update', $healthRecord->id) }}" method="POST" class="mb-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select name="patient_id" id="patient_id" class="form-select" required>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ $healthRecord->patient_id == $patient->id ? 'selected' : '' }}>
                    {{ $patient->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" required>{{ $healthRecord->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="record_type" class="form-label">Type</label>
        <select name="record_type" id="record_type" class="form-select" required>
            <option value="diagnosis" {{ $healthRecord->record_type == 'diagnosis' ? 'selected' : '' }}>Diagnosis</option>
            <option value="medication" {{ $healthRecord->record_type == 'medication' ? 'selected' : '' }}>Medication</option>
            <option value="allergy" {{ $healthRecord->record_type == 'allergy' ? 'selected' : '' }}>Allergy</option>
            <option value="test_result" {{ $healthRecord->record_type == 'test_result' ? 'selected' : '' }}>Test Result</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection