<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index() {
        $requests = Request::all();
        return response()->json($requests);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'lab_id' => 'required|exists:labs,id',
            'user_id' => 'required|exists:users,id',
            'request_date' => 'required|date',
            'sessions' => 'required|array',
            'sessions.*' => 'exists:sessions,id'
        ]);

        // Create the request
        $newRequest = Request::create([
            'lab_id' => $validatedData['lab_id'],
            'user_id' => $validatedData['user_id'],
            'request_date' => $validatedData['request_date'],
            'major' => $request->major,
            'subject' => $request->subject,
            'generation' => $request->generation,
            'software_need' => $request->software_need,
            'number_of_student' => $request->number_of_student,
            'additional' => $request->additional,
        ]);

        // Attach the sessions to the request
        $newRequest->sessions()->attach($validatedData['sessions']);

        return response()->json(['message' => 'Request created successfully', 'request' => $newRequest], 201);
    }


    public function attachSessions(HttpRequest $request, $requestId)
    {
        $validatedData = $request->validate([
            'sessions' => 'required|array',
            'sessions.*' => 'exists:sessions,id',
        ]);

        $requestModel = Request::findOrFail($requestId);
        $requestModel->sessions()->attach($validatedData['sessions']);

        return response()->json(['message' => 'Sessions attached successfully']);
    }

    public function detachSession($requestId, $sessionId)
    {
        $requestModel = Request::findOrFail($requestId);
        $requestModel->sessions()->detach($sessionId);

        return response()->json(['message' => 'Session detached successfully']);
    }



    public function show($id) {
        $request = Request::with('sessions', 'lab', 'user')->findOrFail($id);
        return response()->json($request);
    }


    public function update(HttpRequest $request, $id) {
        $requestData = Request::findOrFail($id);
        $requestData->update($request->all());
        return response()->json($requestData);
    }

    public function destroy($id) {
        $request = Request::findOrFail($id);
        $request->delete();
        return response()->json(null, 204);
    }
}

