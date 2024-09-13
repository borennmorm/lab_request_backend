<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index() {
        $approvals = Approval::all();
        return response()->json($approvals);
    }

    public function store(Request $request) {
        $approval = Approval::create($request->all());
        return response()->json($approval, 201);
    }

    public function show($id) {
        $approval = Approval::findOrFail($id);
        return response()->json($approval);
    }

    public function update(Request $request, $id) {
        $approval = Approval::findOrFail($id);
        $approval->update($request->all());
        return response()->json($approval);
    }

    public function destroy($id) {
        $approval = Approval::findOrFail($id);
        $approval->delete();
        return response()->json(null, 204);
    }
}

