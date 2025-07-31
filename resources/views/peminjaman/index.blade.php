@extends('layouts.app')

@section('title', 'Data Peminjaman - SIMOBA')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Peminjaman Mobil</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Peminjaman Mobil</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Peminjaman
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Peminjaman Hari Ini -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="bi bi-calendar-day me-2"></i>
            Peminjaman Hari Ini ({{ date('d F Y') }})
        </h5>
    </div>
    <div class="card-body">
        @if($peminjamanHariIni->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Bidang</th>
                            <th width="15%">Mobil</th>
                            <th width="15%">Waktu</th>
                            <th width="20%">Tempat Kegiatan</th>
                            <th width="15%">Nama Acara</th>
                            <th width="15%">Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamanHariIni as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge bg-info">{{ $item->bidang->nama_bidang }}</span>
                            </td>
                            <td>
                                <strong>{{ $item->mobil->nama_mobil }}</strong><br>
                                <small class="text-muted">{{ $item->mobil->nomor_polisi }}</small>
                            </td>
                            <td>
                                <small>{{ $item->waktu_peminjaman->format('H:i') }}</small>
                            </td>
                            <td>{{ $item->tempat_kegiatan }}</td>
                            <td>{{ $item->nama_acara }}</td>
                            <td>{{ $item->penanggung_jawab }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-3">
                <i class="bi bi-calendar-x text-muted" style="font-size: 2rem;"></i>
                <p class="text-muted mt-2 mb-0">Tidak ada peminjaman hari ini</p>
            </div>
        @endif
    </div>
</div>

<!-- Riwayat Peminjaman -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-clock-history me-2"></i>
            Riwayat Peminjaman
        </h5>
    </div>
    <div class="card-body">
        @if($peminjaman->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Bidang</th>
                            <th width="12%">Mobil</th>
                            <th width="15%">Waktu Peminjaman</th>
                            <th width="18%">Tempat Kegiatan</th>
                            <th width="15%">Nama Acara</th>
                            <th width="13%">Penanggung Jawab</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->bidang->nama_bidang }}</span>
                            </td>
                            <td>
                                <strong>{{ $item->mobil->nama_mobil }}</strong><br>
                                <small class="text-muted">{{ $item->mobil->nomor_polisi }}</small>
                            </td>
                            <td>
                                <strong>{{ $item->waktu_peminjaman->format('d/m/Y') }}</strong><br>
                                <small class="text-muted">{{ $item->waktu_peminjaman->format('H:i') }}</small>
                            </td>
                            <td>{{ $item->tempat_kegiatan }}</td>
                            <td>{{ $item->nama_acara }}</td>
                            <td>{{ $item->penanggung_jawab }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('peminjaman.edit', $item) }}" 
                                       class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('peminjaman.destroy', $item) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-check text-muted" style="font-size: 4rem;"></i>
                <h5 class="mt-3 text-muted">Belum ada data peminjaman</h5>
                <p class="text-muted">Klik tombol "Tambah Peminjaman" untuk menambahkan data peminjaman baru.</p>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Peminjaman Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection