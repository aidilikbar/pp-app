<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpHealthRecord;
use App\Models\Patient;

class HealthRecordController extends Controller
{
    public function index()
    {
        $healthRecords = PpHealthRecord::with('patient')->get();
        return view('health_records.index', compact('healthRecords'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('health_records.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'description' => 'required|string',
            'record_type' => 'required|in:diagnosis,medication,allergy,test_result',
        ]);

        PpHealthRecord::create($request->all());
        return redirect()->route('health-records.index')->with('success', 'Health record created successfully.');
    }

    public function edit($id)
    {
        $healthRecord = PpHealthRecord::findOrFail($id);
        $patients = Patient::all();
        return view('health_records.edit', compact('healthRecord', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'description' => 'required|string',
            'record_type' => 'required|in:diagnosis,medication,allergy,test_result',
        ]);

        $healthRecord = PpHealthRecord::findOrFail($id);
        $healthRecord->update($request->all());
        return redirect()->route('health-records.index')->with('success', 'Health record updated successfully.');
    }

    public function destroy($id)
    {
        $healthRecord = PpHealthRecord::findOrFail($id);
        $healthRecord->delete();
        return redirect()->route('health-records.index')->with('success', 'Health record deleted successfully.');
    }
}
