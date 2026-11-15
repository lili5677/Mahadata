
@extends('layout')
@section('judul', 'ADMIN')
@section('isi')

<!-- HEADER HALAMAN -->
<div class="mb-4">
    <h3 class="fw-bold text-dark mb-1">
        Manajemen Data Mahasiswa
    </h3>
</div>

<!-- TOMBOL TAMBAH -->
<div class="d-flex justify-content-between align-items-center mb-3">

    <h6 class="fw-bold mb-0">
        Daftar Mahasiswa
    </h6>

    <a href="{{ route('admin.create') }}" class="btn btn-success btn-sm px-3">
        + Tambah Data
    </a>

</div>

<!-- TABEL -->
<div class="card border-0 shadow-sm rounded-3 overflow-hidden">

    @include('tabel', ['aksi' => true])

</div>

@endsection
