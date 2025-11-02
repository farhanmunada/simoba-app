@extends('layouts.app')

@section('title', 'Edit Peminjaman - SIMOBA')

@section('content')
    <div class="page-header">
        <h1>Edit Peminjaman Mobil</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman Mobil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Peminjaman</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil me-2"></i>
                        Form Edit Peminjaman
                    </h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="bi bi-exclamation-triangle me-2"></i>Terjadi kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bidang_id" class="form-label">
                                        <i class="bi bi-building me-1"></i>
                                        Bidang <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('bidang_id') is-invalid @enderror" id="bidang_id"
                                        name="bidang_id" required>
                                        <option value="">Pilih Bidang</option>
                                        @foreach ($bidang as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('bidang_id', $peminjaman->bidang_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bidang_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobil_id" class="form-label">
                                        <i class="bi bi-car-front me-1"></i>
                                        Mobil <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('mobil_id') is-invalid @enderror" id="mobil_id"
                                        name="mobil_id" required>
                                        <option value="">Pilih Mobil</option>
                                        @foreach ($mobil as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('mobil_id', $peminjaman->mobil_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_mobil }} ({{ $item->nomor_polisi }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mobil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="waktu_mulai" class="form-label">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    Waktu Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                    id="waktu_mulai" name="waktu_mulai"
                                    value="{{ old('waktu_mulai', $peminjaman->waktu_mulai->format('Y-m-d\TH:i')) }}"
                                    required>
                                @error('waktu_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="waktu_selesai" class="form-label">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Waktu Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local"
                                    class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai"
                                    name="waktu_selesai"
                                    value="{{ old('waktu_selesai', $peminjaman->waktu_selesai->format('Y-m-d\TH:i')) }}"
                                    required>
                                @error('waktu_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tempat_kegiatan" class="form-label">
                                <i class="bi bi-geo-alt me-1"></i>
                                Tempat Kegiatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('tempat_kegiatan') is-invalid @enderror"
                                id="tempat_kegiatan" name="tempat_kegiatan"
                                value="{{ old('tempat_kegiatan', $peminjaman->tempat_kegiatan) }}"
                                placeholder="Contoh: Kantor Gubernur" required>
                            @error('tempat_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_acara" class="form-label">
                                <i class="bi bi-calendar-check me-1"></i>
                                Nama Acara <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_acara') is-invalid @enderror"
                                id="nama_acara" name="nama_acara" value="{{ old('nama_acara', $peminjaman->nama_acara) }}"
                                placeholder="Contoh: Rapat Koordinasi RKPD" required>
                            @error('nama_acara')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="penanggung_jawab" class="form-label">
                                <i class="bi bi-person me-1"></i>
                                Penanggung Jawab <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                id="penanggung_jawab" name="penanggung_jawab"
                                value="{{ old('penanggung_jawab', $peminjaman->penanggung_jawab) }}"
                                placeholder="Contoh: Budi Santoso" required>
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>
                                Update
                            </button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Informasi Peminjaman
                    </h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Dibuat:</strong><br>
                        {{ $peminjaman->created_at->format('d F Y H:i') }}<br><br>

                        <strong>Terakhir Diubah:</strong><br>
                        {{ $peminjaman->updated_at->format('d F Y H:i') }}<br><br>

                        <strong>Data Saat Ini:</strong><br>
                        • Bidang: {{ $peminjaman->bidang->nama_bidang }}<br>
                        • Mobil: {{ $peminjaman->mobil->nama_mobil }}<br>
                        • Mulai: {{ $peminjaman->waktu_mulai->format('d/m/Y H:i') }}<br>
                        • Selesai: {{ $peminjaman->waktu_selesai->format('d/m/Y H:i') }}<br><br>

                        <strong>Catatan:</strong><br>
                        Pastikan data yang diubah sudah benar sebelum menyimpan.
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
