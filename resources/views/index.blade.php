@extends('layouts.guest')

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h3 class="text-center">Halo, Selamat Datang</h3>
        @if (Auth::check())
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ url('track-expenses/admin') }}" class="btn btn-info">Halaman Dashboard Admin</a>
            @else
                <a href="{{ url('track-expenses') }}" class="btn btn-info">Halaman Dashboard</a>
            @endif
        @else
            <a href="{{ url('login') }}" class="btn btn-primary">Buat Akun</a>
        @endif
    </div>
@endsection
