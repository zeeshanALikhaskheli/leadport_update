<?php

namespace App\Http\Controllers;

use App\Models\LogisticsData;
use Illuminate\Http\Request;

class LogisticsController extends Controller
{
    public function index()
    {
        // Fetch all logistics data
        $logistics = LogisticsData::all();
        return response()->json($logistics);
    }

    public function store(Request $request)
    {
        // Validate and store logistics data
        $validated = $request->validate([
            'request_type' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'shipping_date' => 'nullable|date',
            'shipping_time' => 'nullable',
            // Add validation for other fields as needed
        ]);

        $logistics = LogisticsData::create($validated);
        return response()->json(['message' => 'Logistics data saved successfully!', 'data' => $logistics]);
    }

    public function show($id)
    {
        // Retrieve a specific logistics record
        $logistics = LogisticsData::findOrFail($id);
        return response()->json($logistics);
    }

    public function update(Request $request, $id)
    {
        // Update an existing logistics record
        $logistics = LogisticsData::findOrFail($id);
        $logistics->update($request->all());
        return response()->json(['message' => 'Logistics data updated successfully!', 'data' => $logistics]);
    }

    public function destroy($id)
    {
        // Delete a logistics record
        LogisticsData::destroy($id);
        return response()->json(['message' => 'Logistics data deleted successfully!']);
    }
}