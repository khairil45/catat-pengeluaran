@extends('layouts.admin')

@section('title', 'Daftar Pengguna')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-2"><span class="text-muted fw-light">Tabel /</span> Daftar Pengguna</h4>
        <!-- Bordered Table -->
        <div class="card">
            <div class="card-header">
                <form action="{{ url('track-expenses/admin/users') }}" method="GET">
                    <div class="input-group input-group" style="width: 200px;">
                        <input type="search" name="search" class="form-control" placeholder="Cari User..."
                            style="height: 30px">
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="max-height: 200px;">
                    <table class="table table-bordered">
                        <thead class="sticky-top bg-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Profil</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number = 1)
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $number++ }}</td>
                                    <td class="text-center"><img src="{{ $user->avatar }}" alt="-"
                                            style="width: 30px"></td>
                                    <td class="w-25">{{ $user->name }}</td>
                                    <td class="w-25">{{ $user->email }}</td>
                                    <td class="text-center">
                                        @if ($user->isOnline())
                                            <span class="badge bg-label-primary">Online</span>
                                        @else
                                            <span class="badge bg-label-danger">Offline</span>
                                        @endif

                                    </td>
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('admin.users.show', ['slug' => $user->slug]) }}"
                                            class="btn btn-sm btn-primary me-2">
                                            Detail
                                        </a>
                                        <form action="{{ route('admin.users.delete', ['slug' => $user->slug]) }}"
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
@endsection
