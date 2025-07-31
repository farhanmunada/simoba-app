@extends('layouts.app')

@section('title', 'Tambah Bidang - SIMOBA')

@section('content')
<div class="page-header">
    <h1>Tambah Bidang</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang.index') }}">Data Bidang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Bidang</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Form Tambah Bidang
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

                <form action="{{ route('bidang.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama_bidang" class="form-label">
                            <i class="bi bi-building me-1"></i>
                            Nama Bidang <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_bidang') is-invalid @enderror" 
                               id="nama_bidang" 
                               name="nama_bidang" 
                               value="{{ old('nama_bidang') }}" 
                               placeholder="Contoh: Sekretariat"
                               required>
                        @error('nama_bidang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Masukkan nama bidang sesuai dengan struktur organisasi Bappeda.
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>
                            Simpan
                        </button>
                        <a href="{{ route('bidang.index') }}" class="btn btn-secondary">
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
                    <i class="bi bi-lightbulb me-2"></i>
                    Contoh Bidang di Bappeda
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Beberapa contoh bidang yang ada di Bappeda:</strong><br><br>
                    
                    • <strong>Sekretariat</strong><br>
                    • <strong>Bidang Penelitian dan Pengembangan (Litbang)</strong><br>
                    • <strong>Bidang Perencanaan Ekonomi dan Infrastruktur Pembangunan Daerah (PEIPD)</strong><br>
                    • <strong>Bidang Evaluasi dan Sistem Data Informasi (ESDI)</strong><br>
                    • <strong>Bidang Perencanaan Pemerintahan dan Manajemen Pembangunan (PPMP)</strong><br><br>
                    
                    <em>Sesuaikan dengan struktur organisasi yang berlaku di daerah Anda.</em>
                </small>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Petunjuk Pengisian
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Tips:</strong><br>
                    • Gunakan nama bidang yang resmi dan sesuai dengan struktur organisasi<br>
                    • Hindari penggunaan singkatan tanpa penjelasan<br>
                    • Pastikan nama bidang mudah dipahami
                </small>
            </div>
        </div>
    </div>
</div>
@endsection