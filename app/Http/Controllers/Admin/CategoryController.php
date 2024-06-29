<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Method untuk menampilkan daftar kategori
    public function index()
    {
        // Mengambil daftar kategori dengan membatasi hasil
        $categories = Category::simplePaginate(10);

        // Menyiapkan data untuk ditampilkan di halaman daftar kategori
        $view_data  = ([
            'categories' => $categories
        ]);

        // Menampilkan halaman daftar kategori dengan data kategori        
        return view('admin.categories.index', $view_data);
    }

    // Method untuk menampilkan form pembuatan kategori baru
    public function create()
    {
        // Menampilkan halaman pembuatan kategori baru
        return view('admin.categories.create');
    }

    // Method untuk menyimpan kategori baru ke dalam penyimpanan
    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'name'     => 'required|string|max:50'
        ]);

        // Membuat dan menyimpan kategori baru
        Category::create([
            'name' => $validated['name']
        ]);

        // Redirect kembali ke halaman daftar kategori
        return redirect('track-expenses/admin/categories');
    }

    // Method untuk menampilkan form pengeditan kategori
    public function edit(string $slug)
    {
        // Mengambil data kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Menampilkan halaman pengeditan kategori dengan data kategori
        $view_data = ([
            'category' => $category
        ]);

        return view('admin.categories.edit', $view_data);
    }

    // Method untuk menyimpan perubahan pada kategori yang diedit
    public function update(Request $request, string $slug)
    {
        // Validasi inputan
        $validated = $request->validate([
            'name'     => 'required|string|max:50'
        ]);

        // Memperbarui kategori
        Category::where('slug', $slug)
            ->update([
                'name'       => $validated['name'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        // Redirect kembali ke halaman daftar kategori
        return redirect('track-expenses/admin/categories');
    }

    // Method untuk menghapus kategori
    public function destroy(string $slug)
    {
        // Menghapus kategori berdasarkan slug
        Category::where('slug', $slug)
            ->delete();

        // Redirect kembali ke halaman daftar kategori
        return redirect('track-expenses/admin/categories');
    }
}
