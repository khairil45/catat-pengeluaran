@extends('layouts.user')

@section('title', 'List pengeluaran')

@section('content')
    <h4 class="text-muted fw-light py-2">List Pengeluaran</h4>
    <!-- Card -->
    <div class="row">
        @foreach ($expenses as $expense)
            <div class="col-lg-3 col-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mt-3">{{ $expense->description }}</h5>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('track-expenses.edit', ['slug' => $expense->slug]) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route('track-expenses.deleteExpense', ['slug' => $expense->slug]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                <li><small>#{{ $expense->category->name }}</small></li>
                                <li><small>{{ 'Rp.' . number_format($expense->amount, 2, ',', '.') }}</small></li>
                                <li><small>{{ $expense->date }}</small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
