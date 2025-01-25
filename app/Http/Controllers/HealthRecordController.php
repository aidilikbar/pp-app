<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use App\Models\Patient;

/**
 * * @OA\Schema(
 *     schema="HealthRecord",
 *     type="object",
 *     title="Health Record",
 *     required={"patient_id", "description", "type"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="patient_id", type="integer", example=42, description="ID of the patient"),
 *     @OA\Property(property="description", type="string", example="Routine checkup"),
 *     @OA\Property(property="type", type="string", example="diagnosis"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-20T18:25:43.511Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-21T18:25:43.511Z")
 * )
 * @OA\Tag(
 *     name="Health Records",
 *     description="API Endpoints for Health Records"
 * )
 */

class HealthRecordController extends Controller
{
    public function index()
    {
        // Paginate the results (10 items per page)
        $healthRecords = HealthRecord::with('patient.user')->paginate(10);

        return view('health_records.index', compact('healthRecords'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('health_records.create', compact('patients'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'description' => 'required|string',
            'record_type' => 'required|string|in:diagnosis,medication,allergy,test_result', // Validate record_type
        ]);

        // Insert the data into the database
        HealthRecord::create([
            'patient_id' => $request->patient_id,
            'description' => $request->description,
            'record_type' => $request->record_type,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('health-records.index')->with('success', 'Health record created successfully!');
    }

    public function edit($id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        $patients = Patient::all();
        return view('health_records.edit', compact('healthRecord', 'patients'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'description' => 'required|string',
            'record_type' => 'required|string|in:diagnosis,medication,allergy,test_result',
        ]);

        // Find the health record by ID
        $healthRecord = HealthRecord::findOrFail($id);

        // Update the record
        $healthRecord->update([
            'description' => $request->description,
            'record_type' => $request->record_type,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('health-records.index')->with('success', 'Health record updated successfully!');
    }

    public function destroy($id)
    {
        $healthRecord = PpHealthRecord::findOrFail($id);
        $healthRecord->delete();
        return redirect()->route('health-records.index')->with('success', 'Health record deleted successfully.');
    }

    // REST API methods with Swagger annotations
    /**
     * @OA\Get(
     *     path="/api/health-records",
     *     tags={"Health Records"},
     *     summary="List all health records",
     *     description="Retrieve a list of all health records.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/HealthRecord"))
     *     )
     * )
     */
    public function apiIndex()
    {
        return response()->json(HealthRecord::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/health-records",
     *     tags={"Health Records"},
     *     summary="Create a new health record",
     *     description="Store a new health record in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/HealthRecord")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Record created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/HealthRecord")
     *     )
     * )
     */
    public function apiStore(Request $request)
    {
        $record = HealthRecord::create($request->all());
        return response()->json($record, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/health-records/{id}",
     *     tags={"Health Records"},
     *     summary="Get a specific health record",
     *     description="Retrieve a specific health record by ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/HealthRecord")
     *     )
     * )
     */
    public function apiShow($id)
    {
        $record = HealthRecord::findOrFail($id);
        return response()->json($record, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/health-records/{id}",
     *     tags={"Health Records"},
     *     summary="Update an existing health record",
     *     description="Update a specific health record by ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/HealthRecord")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Record updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/HealthRecord")
     *     )
     * )
     */
    public function apiUpdate(Request $request, $id)
    {
        $record = HealthRecord::findOrFail($id);
        $record->update($request->all());
        return response()->json($record, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/health-records/{id}",
     *     tags={"Health Records"},
     *     summary="Delete a health record",
     *     description="Remove a specific health record by ID from the database.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Record deleted successfully"
     *     )
     * )
     */
    public function apiDestroy($id)
    {
        $record = HealthRecord::findOrFail($id);
        $record->delete();
        return response()->noContent();
    }
}
