@extends('layouts.admin')

@section('title', 'Daftar kategori')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-2"><span class="text-muted fw-light">Tabel /</span>Kategori</h4>
        <!-- Bordered Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url('track-expenses/admin/categories/create') }}" class="btn btn-secondary">Tambah
                    Kategori</a>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="max-height: 180px;">
                    <table class="table table-bordered">
                        <thead class="sticky-top bg-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Update Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number = 1)
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $number++ }}</td>
                                    <td class="w-50">{{ $category->name }}</td>
                                    <td class="text-center">{{ $category->updated_at }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('admin.categories.edit', ['slug' => $category->slug]) }}"
                                            class="btn btn-sm btn-warning mr-1">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.categories.delete', ['slug' => $category->slug]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
@endsection
