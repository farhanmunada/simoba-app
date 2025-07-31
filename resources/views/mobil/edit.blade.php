@extends('layouts.app')

@section('title', 'Edit Mobil - SIMOBA')

@section('content')
<div class="page-header">
    <h1>Edit Mobil</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mobil.index') }}">Data Mobil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Mobil</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-pencil me-2"></i>
                    Form Edit Mobil
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

                <form action="{{ route('mobil.update', $mobil) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nama_mobil" class="form-label">
                            <i class="bi bi-car-front me-1"></i>
                            Nama Mobil <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_mobil') is-invalid @enderror" 
                               id="nama_mobil" 
                               name="nama_mobil" 
                               value="{{ old('nama_mobil', $mobil->nama_mobil) }}" 
                               placeholder="Contoh: Toyota Avanza"
                               required>
                        @error('nama_mobil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nomor_polisi" class="form-label">
                            <i class="bi bi-hash me-1"></i>
                            Nomor Polisi <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nomor_polisi') is-invalid @enderror" 
                               id="nomor_polisi" 
                               name="nomor_polisi" 
                               value="{{ old('nomor_polisi', $mobil->nomor_polisi) }}" 
                               placeholder="Contoh: B 1234 ABC"
                               style="text-transform: uppercase;"
                               required>
                        @error('nomor_polisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label">
                            <i class="bi bi-file-text me-1"></i>
                            Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" 
                                  name="keterangan" 
                                  rows="3"
                                  placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $mobil->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>
                            Update
                        </button>
                        <a href="{{ route('mobil.index') }}" class="btn btn-secondary">
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
                    Informasi Mobil
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <strong>Dibuat:</strong><br>
                    {{ $mobil->created_at->format('d F Y H:i') }}<br><br>
                    
                    <strong>Terakhir Diubah:</strong><br>
                    {{ $mobil->updated_at->format('d F Y H:i') }}<br><br>
                    
                    <strong>Catatan:</strong><br>
                    Pastikan data yang dimasukkan sudah benar sebelum menyimpan perubahan.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto uppercase nomor polisi
    document.getElementById('nomor_polisi').addEventListener('input', function(e) {
        e.target.value = e.target.value.toUpperCase();
    });
</script>
@endpush