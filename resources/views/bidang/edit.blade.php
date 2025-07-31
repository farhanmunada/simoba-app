@extends('layouts.app')

@section('title', 'Edit Bidang - SIMOBA')

@section('content')
<div class="page-header">
    <h1>Edit Bidang</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang.index') }}">Data Bidang</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Bidang</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-pencil me-2"></i>
                    Form Edit Bidang
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

                <form action="{{ route('bidang.update', $bidang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nama_bidang" class="form-label">
                            <i class="bi bi-building me-1"></i>
                            Nama Bidang <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_bidang') is-invalid @enderror" 
                               id="nama_bidang" 
                               name="nama_bidang" 
                               value="{{ old('nama_bidang', $bidang->nama_bidang) }}" 
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
                            Update
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
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Bidang
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Dibuat:</strong><br>
                    {{ $bidang->created_at->format('d F Y H:i') }}<br><br>
                    
                    <strong>Terakhir Diubah:</strong><br>
                    {{ $bidang->updated_at->format('d F Y H:i') }}<br><br>
                    
                    <strong>Total Peminjaman:</strong><br>
                    {{ $bidang->peminjaman->count() }} kali peminjaman<br><br>
                    
                    <strong>Catatan:</strong><br>
                    Pastikan nama bidang sudah sesuai sebelum menyimpan perubahan.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection