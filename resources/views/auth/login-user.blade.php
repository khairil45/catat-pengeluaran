@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <!-- Login -->
    <!-- Logo -->
    <div class="app-brand justify-content-center">
        <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/avatars/icon.png') }}" alt="logo" style="width: 45px">
            </span>
            <span class="app-brand-text demo text-body fw-bolder">Catat Hemat</span>
        </a>
    </div>
    <!-- /Logo -->
    <a href="{{ route('auth.redirect') }}" class="btn border d-block mb-1">
        <img src="http://www.androidpolice.com/wp-content/themes/ap2/ap_resize/ap_resize.php?src=http%3A%2F%2Fwww.androidpolice.com%2Fwp-content%2Fuploads%2F2015%2F10%2Fnexus2cee_Search-Thumb-150x150.png&w=150&h=150&zc=3"
            alt="Google Logo" style="height:25px">
        <span class="ms-2">Daftar/ Masuk with Google</span>
    </a>
    <!-- /Login -->
@endsection
