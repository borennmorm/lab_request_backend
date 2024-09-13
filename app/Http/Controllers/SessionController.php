<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index() {
        $sessions = Session::all();
        return response()->json($sessions);
    }

    public function store(Request $request) {
        $session = Session::create($request->all());
        return response()->json($session, 201);
    }

    public function show($id) {
        $session = Session::findOrFail($id);
        return response()->json($session);
    }

    public function update(Request $request, $id) {
        $session = Session::findOrFail($id);
        $session->update($request->all());
        return response()->json($session);
    }

    public function destroy($id) {
        $session = Session::findOrFail($id);
        $session->delete();
        return response()->json(null, 204);
    }
}

