<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ✅ Show all active products (Soft deleted ones are hidden by default)
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // ✅ Show form to create new product
    public function create()
    {
        return view('products.create');
    }

    // ✅ Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $validated['name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // ✅ Show single product details
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // ✅ Show edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // ✅ Update product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // ✅ Soft delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->get(); // ✅ Get only soft-deleted products
        return view('products.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if ($product) {
            $product->restore(); // ✅ Restore the product
            return redirect()->route('products.trash')->with('success', 'Product restored successfully!');
        }
        return redirect()->route('products.trash')->with('error', 'Product not found!');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if ($product) {
            $product->forceDelete(); // ✅ Permanently delete
            return redirect()->route('products.trash')->with('success', 'Product permanently deleted!');
        }
        return redirect()->route('products.trash')->with('error', 'Product not found!');
    }
}