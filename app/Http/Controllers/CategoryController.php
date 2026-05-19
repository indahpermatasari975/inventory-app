<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Fungsi 1: Untuk membaca seluruh data dan menampilkannya di tabel HTML
    public function index()
    {
        // Category::latest()->get() mengambil data urut dari yang paling baru ditambah
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    // Fungsi 2: Menampilkan halaman HTML form untuk input kategori baru
    public function create()
    {
        return view('categories.create');
    }

    // Fungsi 3: Menangkap data kiriman form dari fungsi "create"
    // dan memasukkannya ke Database
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Satu Kategori berhasil ditambahkan!');
    }

    // Fungsi 4: Menampilkan halaman form edit
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Fungsi 5: Mengupdate data kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' .
                      $category->id . '|max:255'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Data Kategori berhasil diupdate!');
    }

    // Fungsi 6: Menghapus data kategori
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Data Kategori berhasil dihapus!');
    }
}
