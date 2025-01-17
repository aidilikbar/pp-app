<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpAppointment;
use App\Models\Patient;
use App\Models\User;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = PpAppointment::with('patient', 'healthcareProfessional')->get();
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
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'healthcare_professional_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        PpAppointment::create($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function edit($id)
    {
        $appointment = PpAppointment::findOrFail($id);
        $patients = Patient::all();
        $healthcareProfessionals = User::where('role', 'general_practitioner')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'healthcareProfessionals'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'healthcare_professional_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment = PpAppointment::findOrFail($id);
        $appointment->update($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = PpAppointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
