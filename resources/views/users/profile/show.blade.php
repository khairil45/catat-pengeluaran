@extends('layouts.user')

@section('title', 'Profil')

@section('content')
    <div class="card mb-4">
        <!-- Account -->
        <div class="card-body">
            <h3 class="text-center mt-3 mb-4">Detail Profil</h3>
            <img src="{{ $user->avatar }}" class="mx-auto d-block rounded" alt="-" height="100" width="100">
            <div class="card-title text-center mt-3">
                <h5>{{ $user->name }}</h5>
                <p class="text-center">Email: {{ $user->email }}</p>
                <form action="{{ route('track-expenses.deleteUser', ['slug' => $user->slug]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Hapus Akun
                    </button>
                </form>
            </div>
        </div>
        <!-- /Account -->
    </div>
@endsection
