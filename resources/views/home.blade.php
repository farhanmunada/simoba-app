@extends('layouts.home_layout')

@section('title', 'Beranda - SIMOBA')

@section('content')
    <style>
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.5s ease-out forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .jadwal-item {
            display: none;
        }

        .jadwal-item.active {
            display: block;
        }
    </style>

    <div class="container py-5">

            <div class="row">
                <!-- Hero Card -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow rounded-4 h-100 d-flex justify-content-center align-items-center bg-light text-center">
                        <div class="card-body">
                            <h1 class="text-primary fw-bold mb-3">Peminjaman Mobil</h1>
                            <h4 class="text-secondary fw-semibold">Bappeda Kabupaten</h4>
                            <p class="text-muted">Layanan peminjaman kendaraan operasional antar bidang.</p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow rounded-4 h-100">
                        <div class="card-header bg-primary text-white fw-bold rounded-top-4">
                            <i class="fa-solid fa-calendar-day me-2"></i>Jadwal Hari Ini
                        </div>
                        <div class="card-body">
                            @if($jadwalHariIni->isEmpty())
                                <p class="text-muted m-0">Tidak ada jadwal hari ini.</p>
                            @else
                                <div id="jadwalHariIniContainer">
                                    @foreach($jadwalHariIni as $index => $item)
                                        <div class="jadwal-item fade-up {{ $index === 0 ? 'active' : '' }}">
                                            <h5 class="fw-bold text-primary mb-1">
                                                <i class="fa-solid fa-car me-1"></i>
                                                {{ $item->mobil->nama_mobil ?? 'Tidak tersedia' }}
                                            </h5>
                                            <div class="text-secondary text-sm">
                                                <div><i class="fa-regular fa-clock me-1"></i> <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($item->waktu_peminjaman)->format('d-m-Y H:i') }}</div>
                                                <div><i class="fa-solid fa-calendar-days me-1"></i> <strong>Acara:</strong> {{ $item->nama_acara }}</div>
                                                <div><i class="fa-solid fa-location-dot me-1"></i> <strong>Tempat:</strong> {{ $item->tempat_kegiatan }}</div>
                                                <div><i class="fa-solid fa-user me-1"></i> <strong>PJ:</strong> {{ $item->penanggung_jawab }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <!-- Jadwal Mendatang -->
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-4 h-100">
                    <div class="card-header bg-primary text-white fw-bold rounded-top-4">
                        <i class="fa-solid fa-calendar-plus me-2"></i>Jadwal Mendatang
                    </div>
                    <div class="card-body">
                        @if($jadwalMendatang->isEmpty())
                            <p class="text-muted m-0">Tidak ada jadwal mendatang.</p>
                        @else
                            <div id="jadwalMendatangContainer">
                                @foreach($jadwalMendatang as $index => $item)
                                    <div class="jadwal-item fade-up {{ $index === 0 ? 'active' : '' }}">
                                        <h5 class="fw-bold text-primary">{{ $item->mobil->nama_mobil ?? 'Tidak tersedia' }}</h5>
                                        <div class="text-secondary text-base">
                                            <div><i class="fa-regular fa-clock me-1"></i> <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($item->waktu_peminjaman)->format('d-m-Y H:i') }}</div>
                                            <div><i class="fa-solid fa-calendar-days me-1"></i> <strong>Acara:</strong> {{ $item->nama_acara }}</div>
                                            <div><i class="fa-solid fa-location-dot me-1"></i> <strong>Tempat:</strong> {{ $item->tempat_kegiatan }}</div>
                                            <div><i class="fa-solid fa-user me-1"></i> <strong>PJ:</strong> {{ $item->penanggung_jawab }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Riwayat Peminjaman -->
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-4 h-100">
                    <div class="card-header bg-secondary text-white fw-bold rounded-top-4">
                        <i class="fa-solid fa-history me-2"></i>Riwayat Peminjaman
                    </div>
                    <div class="card-body">
                        @if($riwayatPeminjaman->isEmpty())
                            <p class="text-muted m-0">Belum ada riwayat peminjaman.</p>
                        @else
                            <div id="riwayatPeminjamanContainer">
                                @foreach($riwayatPeminjaman as $index => $item)
                                    <div class="jadwal-item fade-up {{ $index === 0 ? 'active' : '' }}">
                                        <h5 class="fw-bold text-primary">{{ $item->mobil->nama_mobil ?? 'Tidak tersedia' }}</h5>
                                        <div class="text-muted small">
                                            <div><i class="fa-regular fa-clock me-1"></i> <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($item->waktu_peminjaman)->format('d-m-Y H:i') }}</div>
                                            <div><i class="fa-solid fa-calendar-days me-1"></i> <strong>Acara:</strong> {{ $item->nama_acara }}</div>
                                            <div><i class="fa-solid fa-location-dot me-1"></i> <strong>Tempat:</strong> {{ $item->tempat_kegiatan }}</div>
                                            <div><i class="fa-solid fa-user me-1"></i> <strong>PJ:</strong> {{ $item->penanggung_jawab }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    {{-- Script Rotasi Otomatis --}}
    <script>
        function rotateItems(containerId, interval = 5000) {
            const container = document.getElementById(containerId);
            if (!container) return;

            const items = container.querySelectorAll('.jadwal-item');
            let current = 0;

            setInterval(() => {
                items[current].classList.remove('active');
                current = (current + 1) % items.length;
                items[current].classList.add('active');
            }, interval);
        }

        document.addEventListener("DOMContentLoaded", function () {
            rotateItems("jadwalHariIniContainer");
            rotateItems("jadwalMendatangContainer");
            rotateItems("riwayatPeminjamanContainer");
        });
    </script>
@endsection
