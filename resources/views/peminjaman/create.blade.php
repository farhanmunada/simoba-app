@extends('layouts.app')

@section('title', 'Tambah Peminjaman - SIMOBA')

@section('content')
<div class="page-header">
    <h1>Tambah Peminjaman Mobil</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman Mobil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Peminjaman</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Form Tambah Peminjaman
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

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bidang_id" class="form-label">
                                    <i class="bi bi-building me-1"></i>
                                    Bidang <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('bidang_id') is-invalid @enderror" 
                                        id="bidang_id" 
                                        name="bidang_id" 
                                        required>
                                    <option value="">Pilih Bidang</option>
                                    @foreach($bidang as $item)
                                        <option value="{{ $item->id }}" {{ old('bidang_id') == $item->id ? 'selected' : '' }}>
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
                                <select class="form-select @error('mobil_id') is-invalid @enderror" 
                                        id="mobil_id" 
                                        name="mobil_id" 
                                        required>
                                    <option value="">Pilih Mobil</option>
                                    @foreach($mobil as $item)
                                        <option value="{{ $item->id }}" {{ old('mobil_id') == $item->id ? 'selected' : '' }}>
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

                    <div class="mb-3">
                        <label for="waktu_peminjaman" class="form-label">
                            <i class="bi bi-calendar-event me-1"></i>
                            Waktu Peminjaman <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" 
                               class="form-control @error('waktu_peminjaman') is-invalid @enderror" 
                               id="waktu_peminjaman" 
                               name="waktu_peminjaman" 
                               value="{{ old('waktu_peminjaman') }}" 
                               required>
                        @error('waktu_peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tempat_kegiatan" class="form-label">
                            <i class="bi bi-geo-alt me-1"></i>
                            Tempat Kegiatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('tempat_kegiatan') is-invalid @enderror" 
                               id="tempat_kegiatan" 
                               name="tempat_kegiatan" 
                               value="{{ old('tempat_kegiatan') }}" 
                               placeholder="Contoh: Kantor Gubernur"
                               required>
                        @error('tempat_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_acara" class="form-label">
                            <i class="bi bi-calendar-check me-1"></i>
                            Nama Acara <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_acara') is-invalid @enderror" 
                               id="nama_acara" 
                               name="nama_acara" 
                               value="{{ old('nama_acara') }}" 
                               placeholder="Contoh: Rapat Koordinasi RKPD"
                               required>
                        @error('nama_acara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="penanggung_jawab" class="form-label">
                            <i class="bi bi-person me-1"></i>
                            Penanggung Jawab <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('penanggung_jawab') is-invalid @enderror" 
                               id="penanggung_jawab" 
                               name="penanggung_jawab" 
                               value="{{ old('penanggung_jawab') }}" 
                               placeholder="Contoh: Budi Santoso"
                               required>
                        @error('penanggung_jawab')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>
                            Simpan
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
                    Petunjuk Pengisian
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Bidang:</strong><br>
                    Pilih bidang yang akan menggunakan mobil.<br><br>
                    
                    <strong>Mobil:</strong><br>
                    Pilih mobil yang akan dipinjam.<br><br>
                    
                    <strong>Waktu Peminjaman:</strong><br>
                    Tentukan tanggal dan jam peminjaman.<br><br>
                    
                    <strong>Tempat Kegiatan:</strong><br>
                    Lokasi tujuan atau tempat kegiatan.<br><br>
                    
                    <strong>Nama Acara:</strong><br>
                    Nama kegiatan atau acara yang akan dihadiri.<br><br>
                    
                    <strong>Penanggung Jawab:</strong><br>
                    Nama orang yang bertanggung jawab atas peminjaman.
                </small>
            </div>
        </div>
        
        @if($bidang->count() == 0 || $mobil->count() == 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0 text-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Perhatian
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    @if($bidang->count() == 0)
                        <strong>Data bidang belum ada.</strong><br>
                        <a href="{{ route('bidang.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bi bi-plus me-1"></i> Tambah Bidang
                        </a><br><br>
                    @endif
                    
                    @if($mobil->count() == 0)
                        <strong>Data mobil belum ada.</strong><br>
                        <a href="{{ route('mobil.create') }}" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bi bi-plus me-1"></i> Tambah Mobil
                        </a>
                    @endif
                </small>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection