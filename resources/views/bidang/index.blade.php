@extends('layouts.app')

@section('title', 'Data Bidang - SIMOBA')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Bidang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Bidang</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('bidang.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Bidang
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

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-building me-2"></i>
            Daftar Bidang
        </h5>
    </div>
    <div class="card-body">
        @if($bidang->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="60%">Nama Bidang</th>
                            <th width="15%">Dibuat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bidang as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $item->nama_bidang }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('bidang.edit', $item) }}" 
                                       class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('bidang.destroy', $item) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus bidang ini?')">
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
                <i class="bi bi-building text-muted" style="font-size: 4rem;"></i>
                <h5 class="mt-3 text-muted">Belum ada data bidang</h5>
                <p class="text-muted">Klik tombol "Tambah Bidang" untuk menambahkan data bidang baru.</p>
                <a href="{{ route('bidang.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Bidang Pertama
                </a>
            </div>
        @endif
    </div>
</div>

@if($bidang->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Contoh Bidang di Bappeda
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="bi bi-dot text-primary"></i> Sekretariat</li>
                            <li class="mb-1"><i class="bi bi-dot text-primary"></i> Bidang Penelitian dan Pengembangan (Litbang)</li>
                            <li class="mb-1"><i class="bi bi-dot text-primary"></i> Bidang Perencanaan Ekonomi dan Infrastruktur Pembangunan Daerah (PEIPD)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="bi bi-dot text-primary"></i> Bidang Evaluasi dan Sistem Data Informasi (ESDI)</li>
                            <li class="mb-1"><i class="bi bi-dot text-primary"></i> Bidang Perencanaan Pemerintahan dan Manajemen Pembangunan (PPMP)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection