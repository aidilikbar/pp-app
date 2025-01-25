<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;

/**
 * @OA\Schema(
 *     schema="Appointment",
 *     type="object",
 *     title="Appointment",
 *     description="Appointment model",
 *     required={"patient_id", "healthcare_professional_id", "appointment_date", "status"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the appointment",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="patient_id",
 *         type="integer",
 *         description="ID of the patient",
 *         example=42
 *     ),
 *     @OA\Property(
 *         property="healthcare_professional_id",
 *         type="integer",
 *         description="ID of the healthcare professional",
 *         example=7
 *     ),
 *     @OA\Property(
 *         property="appointment_date",
 *         type="string",
 *         format="date-time",
 *         description="Date and time of the appointment",
 *         example="2025-01-24T14:30:00Z"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status of the appointment",
 *         example="confirmed"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the appointment was created",
 *         example="2025-01-23T14:30:00Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the appointment was last updated",
 *         example="2025-01-23T15:30:00Z"
 *     )
 * )
 * @OA\Tag(
 *     name="Appointments",
 *     description="API Endpoints for Managing Appointments"
 * )
 */

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

    /**
     * @OA\Get(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Get list of appointments",
     *     description="Returns list of appointments",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Appointment"))
     *     )
     * )
     */
    public function apiIndex()
    {
        $appointments = Appointment::all();
        return response()->json($appointments, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Create a new appointment",
     *     description="Create a new appointment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment created",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     )
     * )
     */
    public function apiStore(Request $request)
    {
        $appointment = Appointment::create($request->all());
        return response()->json($appointment, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Get appointment details",
     *     description="Returns a single appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     )
     * )
     */
    public function apiShow($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json($appointment, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Update an appointment",
     *     description="Update an appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment updated",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     )
     * )
     */
    public function apiUpdate(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response()->json($appointment, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Delete an appointment",
     *     description="Deletes an appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     )
     * )
     */
    public function apiDestroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(null, 204);
    }
}
