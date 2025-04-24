<?php

namespace App\Http\Controllers;

use App\Models\Prodcuts;
use Illuminate\Http\Request;

class ProdcutsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Prodcuts::all();
    }


    public function create(Request $request)
    {

    }


    public function store(Request $request)
    {
        return Prodcuts::create($request->all());

    }


    public function update(Request $request,$id )
    {
        $products = Prodcuts::FindOrFail($id);
        $products->update($request->all());
        return response()->json($products);
    }


    public function destroy($id)
    {
        $products = Prodcuts::FindOrFail($id);
        if ($products) {
            $products->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
