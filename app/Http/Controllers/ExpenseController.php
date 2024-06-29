<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    // Method untuk menampilkan daftar expense pengguna
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil semua expense yang dimiliki oleh pengguna
        $expenses = Expense::where('user_id', $userId)->get();

        // Menampilkan halaman daftar expense pengguna dengan data expense
        return view('users.expenses.index', compact('expenses'));
    }

    // Method untuk menampilkan halaman pembuatan expense baru
    public function create()
    {
        // Mengambil semua kategori expense
        $categories = Category::all();

        // Menampilkan halaman pembuatan expense dengan data kategori
        return view('users.expenses.create', compact('categories'));
    }

    // Method untuk menyimpan expense baru yang dibuat oleh pengguna
    public function store(Request $request)
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = Auth::user();

        // Validasi inputan
        $validated = $request->validate([
            'description' => 'max:50',
            'category_id' => 'required',
            'amount'      => 'numeric',
            'date'        => 'date'
        ]);

        // Menyimpan expense baru
        Expense::create([
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'amount'      => $validated['amount'],
            'date'        => $validated['date'],
            'user_id'     => $user->id
        ]);

        // Redirect ke halaman daftar expense pengguna
        return redirect('track-expenses/list');
    }

    // Method untuk menampilkan halaman pengeditan expense
    public function edit(string $slug)
    {
        // Mengambil data expense berdasarkan slug
        $expense = Expense::where('slug', $slug)->with('category')->first();

        // Mengambil semua kategori expense
        $categories = Category::all();

        // Menampilkan halaman pengeditan expense dengan data expense dan kategori
        $view_data = [
            'expense' => $expense,
            'categories' => $categories,
        ];

        return view('users.expenses.edit', $view_data);
    }

    // Method untuk menyimpan perubahan pada expense yang diedit
    public function update(Request $request, string $slug)
    {
        // Mendapatkan informasi pengguna yang sedang login
        $user = Auth::user();

        // Validasi inputan
        $validated = $request->validate([
            'description' => 'max:50',
            'category_id' => 'required',
            'amount'      => 'numeric',
            'date'        => 'date'
        ]);

        // Memperbarui expense
        Expense::where('slug', $slug)
            ->update([
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'amount'      => $validated['amount'],
                'date'        => $validated['date'],
                'user_id'     => $user->id,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

        // Redirect ke halaman daftar expense pengguna
        return redirect('track-expenses/list');
    }

    // Method untuk menghapus expense
    public function destroy(string $slug)
    {
        // Menghapus expense berdasarkan slug
        Expense::where('slug', $slug)
            ->delete();

        // Redirect ke halaman daftar expense pengguna
        return redirect('track-expenses/list');
    }
}