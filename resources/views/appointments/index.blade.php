@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="container mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">
            Create New Appointment
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Healthcare Professional</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($appointments as $appointment)
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $appointment->patient->user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment->healthcareProfessional->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment->appointment_date }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $appointment->status }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            Edit
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $appointments->links() }}
    </div>
</div>
@endsection