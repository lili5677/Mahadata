
@extends('layout')

@section('judul', 'Form Mahasiswa')

@section('isi')

@php($edit = $mahasiswa->exists)

<div class="row justify-content-center py-4">

    <div class="col-12 col-md-9 col-lg-8 col-xl-7">

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <!-- HEADER FORM -->
            <div class="card-header bg-primary-subtle border-0 px-4 py-4">
                <h4 class="fw-semibold text-primary-emphasis mb-1">
                    {{ $edit ? 'Edit Data Mahasiswa' : 'Tambah Data Mahasiswa' }}
                </h4>

                <p class="text-secondary small mb-0">
                    Lengkapi informasi mahasiswa dengan benar.
                </p>
            </div>

            <!-- BODY FORM -->
            <div class="card-body p-4">

                <!-- ERROR VALIDASI -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali data yang dimasukkan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post"
                    action="{{ $edit ? route('admin.update', $mahasiswa) : route('admin.store') }}">

                    @csrf

                    @if ($edit)
                        @method('PUT')
                    @endif

                    <!-- NIM -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Nomor Induk Mahasiswa (NIM)
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nim"
                            class="form-control"
                            placeholder="Contoh: 2210511090"
                            value="{{ old('nim', $mahasiswa->nim) }}"
                            @readonly($edit)
                            required
                        >

                        <div class="form-text">
                            Gunakan NIM sesuai format resmi fakultas.
                        </div>
                    </div>

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama lengkap mahasiswa"
                            value="{{ old('nama', $mahasiswa->nama) }}"
                            required
                        >
                    </div>

                    <!-- TANGGAL LAHIR DAN GENDER -->
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">
                                Tanggal Lahir
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                class="form-control"
                                value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir?->format('Y-m-d')) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small">
                                Jenis Kelamin
                                <span class="text-danger">*</span>
                            </label>

                            <select name="gender" class="form-select" required>
                                <option value="">Pilih Jenis Kelamin</option>

                                <option value="L"
                                    @selected(old('gender', $mahasiswa->gender) == 'L')>
                                    Laki-laki
                                </option>

                                <option value="P"
                                    @selected(old('gender', $mahasiswa->gender) == 'P')>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">
                            Alamat Lengkap
                            <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat lengkap tempat tinggal mahasiswa"
                            required
                        >{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    </div>

                    <!-- TOMBOL -->
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('admin.index') }}"
                            class="btn btn-light border px-4">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            {{ $edit ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
