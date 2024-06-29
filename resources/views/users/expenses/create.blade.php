@extends('layouts.user')

@section('title', 'Tambah pengeluaran')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Form Pengeluaran</h5>
        <div class="card-body">
            <div>
                <form action="{{ url('track-expenses') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Deskripsi:</label>

                                <input type="text" class="form-control" name="description" placeholder="Tulis Deskripsi">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Pilih Kategori:</label>

                                <select class="form-select select2 select2-danger" data-dropdown-css-class="select2-danger"
                                    style="width: 100%;" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Rp:</label>

                        <input type="text" class="form-control" name="amount" placeholder="10000" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tgl. Transaksi:</label>

                        <input type="date" class="form-control" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd/mm/yyyy" data-mask name="date" required>
                    </div>

                    <a href="{{ url('track-expenses') }}" class="btn btn-info">
                        <i class='bx bx-left-arrow-alt'></i>
                        <span class="ms-1">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save fs-4'></i>
                        <span class="ms-1">Simpan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
