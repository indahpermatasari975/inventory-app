<?php

namespace App\Http\Controllers;

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

    public function insert()
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Produk Baru',
            'price' => 100000,
            'stock' => 10,
            'description' => 'Produk hasil insert',
            'status' => 'tersedia'
        ]);

        return redirect('/products')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->update([
                'name' => 'Produk Updated',
                'price' => 200000,
                'stock' => 5,
                'description' => 'Data sudah diupdate',
                'status' => 'habis'
            ]);
        }

        return redirect('/products')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }

        return redirect('/products')->with('success', 'Data berhasil dihapus');
    }
}
