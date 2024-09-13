<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index() {
        $labs = Lab::all();
        return response()->json($labs);
    }

    public function store(Request $request) {
        $lab = Lab::create($request->all());
        return response()->json($lab, 201);
    }

    public function show($id) {
        $lab = Lab::findOrFail($id);
        return response()->json($lab);
    }

    public function update(Request $request, $id) {
        $lab = Lab::findOrFail($id);
        $lab->update($request->all());
        return response()->json($lab);
    }

    public function destroy($id) {
        $lab = Lab::findOrFail($id);
        $lab->delete();
        return response()->json(null, 204);
    }
}

