<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Custormer;

use Illuminate\Http\Request;

class CustormersController extends Controller
{
    public function index()
    {

        return Custormer::all();
    }

    public function store(Request $request)
    {
        return Custormer::create($request->all());
    }

    public function update(Request $request, $id)
    {

        $user = Custormer::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }
    public function destroy($id)
    {
        $user = Custormer::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
