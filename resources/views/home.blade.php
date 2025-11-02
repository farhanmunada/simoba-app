@extends('layouts.home_layout')

@section('content')
    <div class="container py-4">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h4 class="mb-0 fw-bold text-primary">Sistem Peminjaman Mobil Bapperida</h4>
                    <small class="text-secondary">Pantau status mobil secara real-time</small>
                </div>
            </div>
        </div>

        <!-- Grid Mobil -->
        <div class="row g-3">
            @foreach ($mobils as $mobil)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ $mobil->gambar ? asset('storage/mobil/' . $mobil->gambar) : asset('images/default-car.png') }}"
                            class="card-img-top rounded-top-4" alt="{{ $mobil->nama_mobil }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center py-4">
                            <h5 class="fw-bold text-dark">{{ $mobil->nama_mobil }}</h5>
                            <span class="badge bg-{{ $mobil->warna }} px-3 py-2">{{ $mobil->status }}</span>
                            <p class="mt-2 mb-3 text-muted small">{{ $mobil->keterangan }}</p>

                            @if ($mobil->status == 'Tersedia')
                                @auth
                                    {{-- Menggunakan route() helper untuk URL yang lebih dinamis --}}
                                    <a href="{{ route('peminjaman.create', ['mobil_id' => $mobil->id]) }}"
                                        class="btn btn-primary btn-sm rounded">
                                        <i class="fa-solid fa-calendar-check me-1"></i> Booking Sekarang
                                    </a>
                                @else
                                    {{-- Menggunakan route() helper --}}
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded">
                                        <i class="fa-solid fa-right-to-bracket me-1"></i> Login untuk Booking
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Riwayat -->
        <div class="mt-5">
            <h5 class="fw-bold text-dark mb-3">Riwayat Peminjaman</h5>
            @if ($riwayat->isEmpty())
                <div class="alert alert-light border rounded-3">Belum ada riwayat peminjaman.</div>
            @else
                <div class="list-group shadow-sm rounded-4">
                    @foreach ($riwayat as $r)
                        <div
                            class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                            <div>
                                <strong>{{ $r->mobil->nama_mobil ?? '-' }}</strong><br>
                                <small class="text-muted">
                                    {{ $r->waktu_mulai->format('d M H:i') }} - {{ $r->waktu_selesai->format('H:i') }}
                                </small>
                            </div>
                            <span class="badge bg-secondary">Selesai</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
