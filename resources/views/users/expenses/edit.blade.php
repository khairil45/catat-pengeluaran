@extends('layouts.user')

@section('title', 'Edit pengeluaran')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Edit Pengeluaran</h5>
        <div class="card-body">
            <div>
                <form action="{{ route('track-expenses.update', ['slug' => $expense->slug]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Deskripsi:</label>

                                <input type="text" class="form-control" name="description"
                                    value="{{ $expense->description }}" placeholder="Tulis Deskripsi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Pilih Kategori:</label>

                                <select class="form-select select2 select2-danger" data-dropdown-css-class="select2-danger"
                                    style="width: 100%;" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $expense->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Rp:</label>

                        <input type="text" class="form-control" name="amount"
                            value="{{ number_format($expense->amount, 0, '.', '') }}" placeholder="10000" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tgl. Transaksi:</label>

                        <input type="date" class="form-control" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd/mm/yyyy" data-mask name="date" value="{{ $expense->date }}"
                            required>
                    </div>

                    <a href="{{ url('track-expenses/list') }}" class="btn btn-info">
                        <i class='bx bx-left-arrow-alt'></i>
                        <span class="ms-1">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save fs-4'></i>
                        <span class="ms-1">Update</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
