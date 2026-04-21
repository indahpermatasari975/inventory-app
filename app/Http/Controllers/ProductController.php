<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil data produk + relasi kategori
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return view('products.index', [
            'products' => $products
        ]);
    }
}
