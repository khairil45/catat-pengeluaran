<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expense;

class AdminController extends Controller
{
    // Method untuk menampilkan dashboard admin
    public function index()
    {
        // Mengambil total expense hari ini dan bulan ini
        $totalExpensesToday  = Expense::getTotalExpensesToday();
        $totalExpensesThisMonth = Expense::getTotalExpensesThisMonth();

        // Menyiapkan data untuk ditampilkan di halaman dashboard admin
        $view_data = ([
            'totalExpensesToday'  => $totalExpensesToday,
            'totalExpensesThisMonth' => $totalExpensesThisMonth,
        ]);

        // Menampilkan halaman dashboard admin dengan data expense
        return view('admin.dashboard', $view_data);
    }

    // Method untuk menampilkan daftar pengguna admin
    public function users(Request $request)
    {
        // Mendapatkan kata kunci pencarian
        $search = $request->search;

        // Mencari pengguna berdasarkan nama dengan membatasi hasil pencarian
        $users  = User::where('name', 'like', '%' . $search . '%')
            ->simplePaginate(10);

        // Menampilkan halaman daftar pengguna admin dengan data pengguna
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Method untuk menampilkan detail pengguna
    public function show(string $slug)
    {
        // Mengambil data pengguna berdasarkan slug dengan relasi transaksi
        $user = User::where('slug', $slug)->with('expenses')->firstOrFail();

        // Menampilkan halaman detail pengguna dengan data pengguna
        $view_data = ([
            'user' => $user
        ]);

        return view('admin.users.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
    }

    // Method untuk menghapus pengguna
    public function destroy(string $slug)
    {
        // Menghapus pengguna berdasarkan slug
        User::where('slug', $slug)
            ->delete();

        // Redirect kembali ke halaman daftar pengguna admin
        return redirect('track-expenses/admin/users');
    }
}
