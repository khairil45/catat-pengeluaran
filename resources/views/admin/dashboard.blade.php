@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                <div class="row">
                    <div class="col-12 col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar mb-2">
                                        <i class='bx bx-calendar-alt' style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                <span>Pengeluaran Bulan Ini</span>
                                <h4 class="card-title text-nowrap mt-1 mb-2">
                                    {{ 'Rp.' . number_format($totalExpensesThisMonth, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar mb-2">
                                        <i class='bx bx-calendar-event' style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                <span>Pengeluaran Hari Ini</span>
                                <h4 class="card-title text-nowrap mt-1 mb-2">
                                    {{ 'Rp.' . number_format($totalExpensesToday, 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
