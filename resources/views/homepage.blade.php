@extends('layouts.app')

@section('title', 'Welcome to Patient Portals')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-4">Welcome to Patient Portals</h1>
    <p class="mb-6">Access your health records, manage appointments, and stay connected with your healthcare providers.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <h2 class="font-bold text-lg">Health Records</h2>
            <p class="text-gray-600">View and manage your medical history and health records.</p>
            <a href="{{ route('health-records.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">View Records</a>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            <h2 class="font-bold text-lg">Appointments</h2>
            <p class="text-gray-600">Schedule, view, and manage your appointments with healthcare providers.</p>
            <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Manage Appointments</a>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            <h2 class="font-bold text-lg">Profile</h2>
            <p class="text-gray-600">Update your personal information and account settings.</p>
            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline mt-2 inline-block">View Profile</a>
        </div>
    </div>
</div>
@endsection