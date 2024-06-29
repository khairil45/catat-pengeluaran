@extends('layouts.admin')

@section('title', 'Tambah kategori')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">Form Kategori</h5>
            <div class="card-body">
                <div>
                    <form action="{{ url('track-expenses/admin/categories') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="form-category" class="form-label">Tambah kategori</label>
                            <input type="text" class="form-control" id="form-category" name="name" />
                        </div>
                        <!-- /.form-group -->
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save fs-4'></i>
                            <span class="ms-1">Simpan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
