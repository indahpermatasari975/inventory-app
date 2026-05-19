<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Habis',
        ]);

        Product::create($validated);

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function insert()
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Produk Baru',
            'price' => 100000,
            'stock' => 10,
            'description' => 'Produk hasil insert',
            'status' => 'Tersedia'
        ]);

        return redirect('/products')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Habis',
        ]);

        $product->update($validated);

        return redirect('/products')
            ->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/products')
            ->with('success', 'Data berhasil dihapus');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/products')
            ->with('success', 'Data berhasil dihapus');
    }
}
