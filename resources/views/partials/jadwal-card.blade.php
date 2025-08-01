<div class="card border-{{ $color }} shadow-sm mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title mb-0">
                🚗 {{ $item->mobil->nama_mobil }}
            </h5>
            <span class="badge bg-{{ $color }}">
                {{ $item->waktu_peminjaman->translatedFormat('d M Y, H:i') }}
            </span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p><strong>📍 Tempat:</strong> {{ $item->tempat_kegiatan }}</p>
                <p><strong>📝 Acara:</strong> {{ $item->nama_acara }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>🏢 Bidang:</strong> {{ $item->bidang->nama_bidang }}</p>
                <p><strong>👤 Penanggung Jawab:</strong> {{ $item->penanggung_jawab }}</p>
            </div>
        </div>
    </div>
</div>
