@extends('layouts.app')

@section('title', 'Data Mobil - SIMOBA')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Data Mobil</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Mobil</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('mobil.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Mobil
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
            <i class="bi bi-car-front me-2"></i>
            Daftar Mobil
        </h5>
    </div>
    <div class="card-body">
        @if($mobil->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Mobil</th>
                            <th width="20%">Nomor Polisi</th>
                            <th width="30%">Keterangan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mobil as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $item->nama_mobil }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $item->nomor_polisi }}</span>
                            </td>
                            <td>
                                {{ $item->keterangan ?: '-' }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mobil.edit', $item) }}" 
                                       class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('mobil.destroy', $item) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
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
                <i class="bi bi-car-front text-muted" style="font-size: 4rem;"></i>
                <h5 class="mt-3 text-muted">Belum ada data mobil</h5>
                <p class="text-muted">Klik tombol "Tambah Mobil" untuk menambahkan data mobil baru.</p>
                <a href="{{ route('mobil.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Mobil Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection