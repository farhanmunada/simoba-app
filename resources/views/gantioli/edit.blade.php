@extends('layouts.app')

@section('title', 'Edit Ganti Oli - SIMOBA')

@section('content')
    <div class="page-header">
        <h1>Edit Ganti Oli</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ganti-oli.index') }}">Riwayat Ganti Oli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Ganti Oli</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil me-2"></i>
                        Form Edit Ganti Oli
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

                    <form action="{{ route('ganti-oli.update', $gantiOli->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Mobil</label>
                            <select name="id_mobil" class="form-control" required>
                                @foreach ($mobil as $m)
                                    <option value="{{ $m->id }}"
                                        {{ $gantiOli->id_mobil == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama_mobil }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Ganti Oli</label>
                            <input type="date" name="tanggal_ganti" class="form-control"
                                value="{{ $gantiOli->tanggal_ganti }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Kilometer Saat Ini</label>
                            <input type="number" name="km_saat_ganti" id="km_saat_ganti" class="form-control"
                                value="{{ $gantiOli->km_saat_ganti }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Kilometer Target Ganti Oli Berikutnya</label>
                            <input type="number" id="km_target_berikutnya" class="form-control"
                                value="{{ $gantiOli->km_target_berikutnya }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Petugas Servis</label>
                            <input type="text" name="petugas_input" class="form-control"
                                value="{{ $gantiOli->petugas_input }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control">{{ $gantiOli->catatan }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>
                                Update
                            </button>
                            <a href="{{ route('ganti-oli.index') }}" class="btn btn-secondary">
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
                        Informasi Ganti Oli
                    </h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Dibuat:</strong><br>
                        {{ $gantiOli->created_at->format('d F Y H:i') }}<br><br>

                        <strong>Terakhir Diubah:</strong><br>
                        {{ $gantiOli->updated_at->format('d F Y H:i') }}<br><br>

                        <strong>Kilometer Saat Ini:</strong><br>
                        {{ $gantiOli->km_saat_ganti }} km<br><br>

                        <strong>Kilometer Target Berikutnya:</strong><br>
                        {{ $gantiOli->km_target_berikutnya }} km<br><br>

                        <strong>Catatan:</strong><br>
                        {{ $gantiOli->catatan ?? '-' }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kmInput = document.getElementById('km_saat_ganti');
        const kmTarget = document.getElementById('km_target_berikutnya');
        const intervalKm = 5000;

        kmInput.addEventListener('input', function() {
            const km = parseInt(kmInput.value) || 0;
            kmTarget.value = km + intervalKm;
        });
    </script>
@endsection
