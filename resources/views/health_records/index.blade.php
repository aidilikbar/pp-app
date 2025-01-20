@extends('layouts.app')

@section('title', 'Health Records')

@section('content')
<div class="container mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Health Records</h1>
        <a href="{{ route('health-records.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">
            Create New Health Record
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($healthRecords as $record)
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $record->patient->user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $record->description }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $record->record_type }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('health-records.edit', $record->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            Edit
                        </a>
                        <form action="{{ route('health-records.destroy', $record->id) }}" method="POST" class="inline">
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
        {{ $healthRecords->links() }}
    </div>
</div>
@endsection