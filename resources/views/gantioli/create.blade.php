@extends('layouts.app')

@section('title', 'Tambah Ganti Oli - SIMOBA')

@section('content')
    <div class="page-header">
        <h1>Tambah Ganti Oli</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ganti-oli.index') }}">Riwayat Ganti Oli</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Ganti Oli</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Input Ganti Oli</h5>
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

                    <form action="{{ route('ganti-oli.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="id_mobil" class="form-label"><i class="bi bi-car-front me-1"></i>Mobil <span
                                    class="text-danger">*</span></label>
                            <select name="id_mobil" id="id_mobil" class="form-control" required>
                                <option value="">-- Pilih Mobil --</option>
                                @foreach ($mobil as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_mobil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_ganti" class="form-label"><i class="bi bi-calendar-event me-1"></i>Tanggal
                                Ganti Oli <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_ganti" id="tanggal_ganti" class="form-control"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="km_saat_ganti" class="form-label"><i class="bi bi-speedometer2 me-1"></i>Kilometer
                                Saat Ini <span class="text-danger">*</span></label>
                            <input type="number" name="km_saat_ganti" id="km_saat_ganti" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="km_target_berikutnya" class="form-label"><i class="bi bi-flag me-1"></i>Kilometer
                                Target Ganti Oli Berikutnya</label>
                            <input type="number" id="km_target_berikutnya" class="form-control" readonly>
                            <small class="text-muted">Terhitung otomatis +5000 km dari km saat ini.</small>
                        </div>

                        <div class="mb-3">
                            <label for="petugas_input" class="form-label"><i class="bi bi-person-check me-1"></i>Petugas
                                Servis <span class="text-danger">*</span></label>
                            <input type="text" name="petugas_input" id="petugas_input" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label"><i class="bi bi-journal-text me-1"></i>Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan</button>
                            <a href="{{ route('ganti-oli.index') }}" class="btn btn-secondary"><i
                                    class="bi bi-arrow-left me-2"></i>Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Petunjuk Pengisian</h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Tips:</strong><br>
                        • Pilih mobil yang akan diservis.<br>
                        • Masukkan km saat ini sesuai odometer mobil.<br>
                        • Km target berikutnya akan dihitung otomatis (+5000 km).<br>
                        • Isikan nama petugas yang melakukan servis.<br>
                        • Catatan bisa diisi untuk keterangan tambahan.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kmInput = document.getElementById('km_saat_ganti');
        const kmTarget = document.getElementById('km_target_berikutnya');
        const intervalKm = 5000; // Interval ganti oli

        kmInput.addEventListener('input', function() {
            const km = parseInt(kmInput.value) || 0;
            kmTarget.value = km + intervalKm;
        });
    </script>
@endsection
