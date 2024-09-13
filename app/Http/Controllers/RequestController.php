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

    public function store(HttpRequest $request) {
        $newRequest = Request::create($request->all());
        return response()->json($newRequest, 201);
    }

    public function show($id) {
        $request = Request::findOrFail($id);
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

