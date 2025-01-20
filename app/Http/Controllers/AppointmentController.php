<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\PpAppointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'healthcareProfessional'])->paginate(10); // Use paginate()
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $healthcareProfessionals = User::where('role', 'general_practitioner')->get();
        return view('appointments.create', compact('patients', 'healthcareProfessionals'));
    }

    public function store(Request $request)
    {
        // Log incoming request data
        \Log::info('Request data:', $request->all());

        // Validate the request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'healthcare_professional_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        \Log::info('Validation passed');

        // Try to create a new appointment
        try {
            Appointment::create([
                'patient_id' => $request->patient_id,
                'healthcare_professional_id' => $request->healthcare_professional_id,
                'appointment_date' => $request->appointment_date,
                'status' => $request->status,
            ]);
            \Log::info('Data inserted successfully');
        } catch (\Exception $e) {
            \Log::error('Error inserting data: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create the appointment. Please try again.']);
        }

        // Redirect to the index page
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $healthcareProfessionals = User::where('role', 'general_practitioner')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'healthcareProfessionals'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'healthcare_professional_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled', // Validate the status field
        ]);

        // Find the appointment
        $appointment = Appointment::findOrFail($id);

        // Update the appointment
        $appointment->update([
            'patient_id' => $request->patient_id,
            'healthcare_professional_id' => $request->healthcare_professional_id,
            'appointment_date' => $request->appointment_date,
            'status' => $request->status, // Update the status
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        $appointment = PpAppointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
