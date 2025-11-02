@extends('layouts.app')

@section('title', 'Edit Mobil - SIMOBA')

@section('content')
    <div class="page-header">
        <h1>Edit Data Mobil</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mobil.index') }}">Manajemen Mobil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Mobil</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
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

                    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_mobil" class="form-label">Nama Mobil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror"
                                id="nama_mobil" name="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}"
                                required>
                            @error('nama_mobil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_polisi" class="form-label">Nomor Polisi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_polisi') is-invalid @enderror"
                                id="nomor_polisi" name="nomor_polisi"
                                value="{{ old('nomor_polisi', $mobil->nomor_polisi) }}" required>
                            @error('nomor_polisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                rows="3">{{ old('keterangan', $mobil->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Ganti Gambar Mobil</label>

                            {{-- Tampilkan gambar saat ini jika ada --}}
                            @if ($mobil->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/mobil/' . $mobil->gambar) }}" alt="Gambar saat ini"
                                        class="img-thumbnail" width="200">
                                </div>
                            @endif

                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar"
                                name="gambar">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF.
                                Maks: 2MB.</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('mobil.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
