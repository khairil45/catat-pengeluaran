@extends('layouts.admin')

@section('title', 'Details Expense')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-2"><span class="text-muted fw-light">Tabel /</span> Details Pengeluaran</h4>
        <!-- Bordered Table -->
        <div class="card">
            {{-- <div class="card-header">
                <form action="{{ url('track-expenses/admin/users') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="search" name="search" class="form-control" value="Cari User..." style="height: 30px">
                    </div>
                </form>
            </div> --}}
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="max-height: 200px;">
                    <table class="table table-bordered">
                        <thead class="sticky-top bg-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Jumlah/Harga</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Tgl. Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number = 1)
                            @foreach ($user->expenses as $expense)
                                <tr>
                                    <td class="text-center">{{ $number++ }}</td>
                                    <td>{{ 'Rp.' . number_format($expense->amount, 2, ',', '.') }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->category->name }}</td>
                                    <td class="text-center">{{ $expense->formatted_transaction_date }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
@endsection
