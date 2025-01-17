@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Appointments</h1>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create New Appointment</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Healthcare Professional</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
        <tr>
            <td>{{ $appointment->patient->user->name }}</td>
            <td>{{ $appointment->healthcareProfessional->name }}</td>
            <td>{{ $appointment->appointment_date }}</td>
            <td>{{ ucfirst($appointment->status) }}</td>
            <td>
                <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection