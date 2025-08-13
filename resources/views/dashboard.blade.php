@extends('layouts.app')

@section('title', 'Dashboard - SIMOBA')

@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-number">{{ $peminjamanHariIni }}</div>
                        <div class="stats-label">Peminjaman Hari Ini</div>
                    </div>
                    <div>
                        <i class="bi bi-calendar-check" style="font-size: 2.5rem; opacity: 0.7;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-number">{{ $totalPeminjaman }}</div>
                        <div class="stats-label">Total Semua Peminjaman</div>
                    </div>
                    <div>
                        <i class="bi bi-clipboard-data" style="font-size: 2.5rem; opacity: 0.7;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Selamat Datang di SIMOBA
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <strong>SIMOBA (Sistem Informasi Mobil Bappeda)</strong> adalah sistem yang dirancang untuk
                        mengelola peminjaman kendaraan dinas di lingkungan Badan Perencanaan Pembangunan Daerah.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-list-check text-primary me-2"></i>
                                Fitur Utama:
                            </h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Manajemen data mobil dinas
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Manajemen data bidang
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Pencatatan peminjaman mobil
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Laporan peminjaman harian
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-speedometer2 text-primary me-2"></i>
                                Menu Navigasi:
                            </h6>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-calendar-check me-1"></i>
                                        Peminjaman
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="{{ route('mobil.index') }}" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-car-front me-1"></i>
                                        Mobil
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="{{ route('bidang.index') }}" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-building me-1"></i>
                                        Bidang
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Tambah Peminjaman
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock me-2"></i>
                        Informasi Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Tanggal:</strong></p>
                            <p class="text-muted">{{ date('d F Y') }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Waktu:</strong></p>
                            <p class="text-muted" id="current-time">{{ date('H:i:s') }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>User:</strong></p>
                            <p class="text-muted">{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Update current time every second
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            document.getElementById('current-time').textContent = timeString;
        }

        setInterval(updateTime, 1000);
    </script>
@endpush
