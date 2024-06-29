@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
            <div class="row">
                <div class="col-6 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar mb-2">
                                    <i class='bx bx-calendar-alt text-primary' style="font-size: 3rem;"></i>
                                </div>
                            </div>
                            <span>Pengeluaran Bulan Ini</span>
                            <h5 class="card-title text-nowrap mt-1 mb-2">
                                {{ 'Rp.' . number_format($monthTransactions, 2, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar mb-2">
                                    <i class='bx bx-calendar-event text-danger' style="font-size: 3rem;"></i>
                                </div>
                            </div>
                            <span>Pengeluaran Hari Ini</span>
                            <h5 class="card-title text-nowrap mt-1 mb-2">
                                {{ 'Rp.' . number_format($todayTransactions, 2, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
