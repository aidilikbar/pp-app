<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
//use App\Models\PpHealthRecord;
use App\Models\Patient;

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
}
