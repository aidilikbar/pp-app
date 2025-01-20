@extends('layouts.app')

@section('title', 'Edit Health Record')

@section('content')
<div class="container mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-6">Edit Health Record</h1>

        <form action="{{ route('health-records.update', $healthRecord->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Patient -->
            <div class="mb-4">
                <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-2">Patient</label>
                <select name="patient_id" id="patient_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                    <option value="{{ $healthRecord->patient_id }}" selected>
                        {{ $healthRecord->patient->user->name }}
                    </option>
                </select>
                <p class="text-sm text-gray-500 mt-2">The patient cannot be changed.</p>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description" required>
                    {{ trim($healthRecord->description) }}
                </textarea>
            </div>

            <!-- Record Type -->
            <div class="mb-4">
                <label for="record_type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="record_type" id="record_type" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="diagnosis" {{ $healthRecord->record_type == 'diagnosis' ? 'selected' : '' }}>Diagnosis</option>
                    <option value="medication" {{ $healthRecord->record_type == 'medication' ? 'selected' : '' }}>Medication</option>
                    <option value="allergy" {{ $healthRecord->record_type == 'allergy' ? 'selected' : '' }}>Allergy</option>
                    <option value="test_result" {{ $healthRecord->record_type == 'test_result' ? 'selected' : '' }}>Test Result</option>
                </select>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update
                </button>
                <a href="{{ route('health-records.index') }}" class="ml-4 bg-gray-500 text-white px-6 py-2 rounded-md shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection