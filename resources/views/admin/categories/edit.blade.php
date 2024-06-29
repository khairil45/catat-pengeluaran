@extends('layouts.admin')

@section('title', 'Edit kategori')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">Form Kategori</h5>
            <div class="card-body">
                <div>
                    <form action="{{ route('admin.categories.update', ['slug' => $category->slug]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-2">
                            <label for="form-category" class="form-label">Edit kategori</label>
                            <input type="text" class="form-control" id="form-category" name="name"
                                value="{{ $category->name }}" />
                        </div>
                        <!-- /.form-group -->
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save fs-4'></i>
                            <span class="ms-1">Update</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
