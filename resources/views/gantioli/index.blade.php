@extends('layouts.app')

@section('title', 'Riwayat Ganti Oli - SIMOBA')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Riwayat Ganti Oli</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Ganti Oli</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('ganti-oli.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Tambah Ganti Oli
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="bi bi-tools me-2"></i>
                Daftar Riwayat Ganti Oli
            </h5>
        </div>
        <div class="card-body">
            @if ($gantiOli->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mobil</th>
                                <th>Tanggal Ganti</th>
                                <th>Km Saat Ganti</th>
                                <th>Km Target Berikutnya</th>
                                <th>Petugas</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gantiOli as $mobilId => $oliMobil)
                                <tr class="table-primary">
                                    <td colspan="8"><strong>{{ $oliMobil->first()->mobil->nama_mobil }}</strong></td>
                                </tr>
                                @foreach ($oliMobil as $index => $go)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $go->mobil->nama_mobil }}</td>
                                        <td>{{ \Carbon\Carbon::parse($go->tanggal_ganti)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($go->km_saat_ganti) }}</td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                {{ number_format($go->km_target_berikutnya) }}
                                            </span>
                                        </td>
                                        <td>{{ $go->petugas_input }}</td>
                                        <td>{{ $go->catatan ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('ganti-oli.edit', $go->id) }}"
                                                    class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('ganti-oli.destroy', $go->id) }}" method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Yakin hapus data ini?')">
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
                            @endforeach
                        </tbody>


                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-tools text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada data ganti oli</h5>
                    <p class="text-muted">Klik tombol "Tambah Ganti Oli" untuk menambahkan data baru.</p>
                    <a href="{{ route('ganti-oli.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Tambah Ganti Oli
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if ($gantiOli->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Info Tambahan
                        </h6>
                    </div>
                    <div class="card-body">
                        <p>Interval ganti oli standar: <strong>5.000 km</strong>. Catatan dapat diisi sesuai kondisi mobil
                            atau kebutuhan perawatan.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
