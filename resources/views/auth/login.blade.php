@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <!-- Login -->
    <form id="formAuthentication" class="mb-3" action="{{ url('login-admin') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter username" autofocus />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
    </form>
    <a href="{{ url('login') }}" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        <i class='bx bx-log-in fs-3'></i>
    </a>
    <!-- /Login -->
@endsection
