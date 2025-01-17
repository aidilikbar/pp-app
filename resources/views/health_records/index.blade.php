@extends('layouts.app')

@section('title', 'Health Records')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Health Records</h1>
    <a href="{{ route('health-records.create') }}" class="btn btn-primary">Create New Health Record</a>
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
            <th>Description</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($healthRecords as $record)
        <tr>
            <td>{{ $record->patient->user->name }}</td>
            <td>{{ $record->description }}</td>
            <td>{{ $record->record_type }}</td>
            <td>
                <a href="{{ route('health-records.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('health-records.destroy', $record->id) }}" method="POST" style="display:inline;">
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