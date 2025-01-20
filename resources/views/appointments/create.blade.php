@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="container mx-auto mt-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-6">Create Appointment</h1>

        <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <!-- Patient -->
        <div class="mb-4">
            <label for="patient_id" class="block text-sm font-medium text-gray-700 mb-2">Patient</label>
            <select name="patient_id" id="patient_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="" disabled selected>Select a Patient</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Healthcare Professional -->
        <div class="mb-4">
            <label for="healthcare_professional_id" class="block text-sm font-medium text-gray-700 mb-2">Healthcare Professional</label>
            <select name="healthcare_professional_id" id="healthcare_professional_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="" disabled selected>Select a Healthcare Professional</option>
                @foreach ($healthcareProfessionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Appointment Date -->
        <div class="mb-4">
            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">Appointment Date</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" id="status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save
            </button>
            <a href="{{ route('appointments.index') }}" class="ml-4 bg-gray-500 text-white px-6 py-2 rounded-md shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Cancel
            </a>
        </div>
    </form>
    </div>
</div>
@endsection