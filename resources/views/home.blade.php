
@extends('layout')

@section('judul', 'HOME')

@section('isi')
<div>
  
</div>
<div class="container-fluid bg-light p-4">

    <!-- JUDUL -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1">
            Daftar Mahasiswa Aktif
        </h3>
        <p class="text-secondary small mb-0">
            Ringkasan statistik dan direktori data mahasiswa
            yang terdaftar pada sistem registrasi semester berjalan.
        </p>
    </div>

    <!-- STATISTIK -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary small mb-2">
                        Total Mahasiswa
                    </p>
                    <h3 class="fw-bold text-primary mb-0">
                        {{ number_format($total, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary small mb-2">
                        Laki-laki
                    </p>
                    <h3 class="fw-bold text-dark mb-0">
                        {{ number_format($rekap['L'], 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-secondary small mb-2">
                        Perempuan
                    </p>
                    <h3 class="fw-bold text-dark mb-0">
                        {{ number_format($rekap['P'], 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <!-- PENCARIAN -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" class="d-flex gap-2">

                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Cari nama mahasiswa..."
                    value="{{ $kata }}"
                >

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-search"></i> Cari
                </button>

            </form>

        </div>
    </div>

    <!-- TABEL MAHASISWA -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

        <div class="card-header bg-white border-0 p-3">
            <h6 class="fw-bold mb-1">
                Data Mahasiswa
            </h6>
            <small class="text-secondary">
                Daftar mahasiswa yang terdaftar
            </small>
        </div>

        <div class="table-responsive">

            @include('tabel', ['aksi' => false])

        </div>

    </div>

</div>

@endsection

