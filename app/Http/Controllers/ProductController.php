<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required | max:255',
            'description' => 'required',
            'price' => 'required | numeric',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required | max:255',
            'description' => 'required',
            'price' => 'required | numeric',
        ]);

        $product = Product::find($id);
        $product->update($validated);

        return response()->json($product, 201);
    }

    public function delete(string $product)
    {
        $product = Product::find($product);
        $product->delete();

        return response('Deleted successfully', 200);
    }
}
