@extends('layouts.app')

@section('title', 'Welcome to Patient Portals')

@section('content')
<div class="container text-center">
    <h1 class="my-4">Welcome to the Patient Portal</h1>
    <p class="lead">
        Access your health records, manage appointments, and stay connected with your healthcare providers.
    </p>

    <div class="row mt-5">
        <!-- Link to Health Records -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Health Records</h5>
                    <p class="card-text">View and manage your medical history and health records.</p>
                    <a href="{{ route('health-records.index') }}" class="btn btn-primary">View Records</a>
                </div>
            </div>
        </div>

        <!-- Link to Appointments -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">Schedule, view, and manage your appointments with healthcare providers.</p>
                    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Manage Appointments</a>
                </div>
            </div>
        </div>

        <!-- Link to Profile or Other Features -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">Update your personal information and account settings.</p>
                    <a href="#" class="btn btn-primary">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection