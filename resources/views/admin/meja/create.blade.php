@extends('layouts.admin')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Meja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/meja">Kelola Meja</a></li>
                        <li class="breadcrumb-item active">Tambah Meja</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Meja</h3>
                        </div>

                        <form method="POST" action="/admin/meja">
                            @csrf

                            <div class="card-body">

                                {{-- Error validasi --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Nomor Meja --}}
                                <div class="mb-3">
                                    <label for="nomor_meja" class="form-label fw-bold">Nomor Meja</label>
                                    <input
                                        type="number"
                                        name="nomor_meja"
                                        id="nomor_meja"
                                        class="form-control @error('nomor_meja') is-invalid @enderror"
                                        placeholder="Contoh: 1, 2, 3 ..."
                                        value="{{ old('nomor_meja') }}"
                                        min="1"
                                        required
                                    >
                                    @error('nomor_meja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Nomor meja harus unik, tidak boleh sama dengan meja yang sudah ada.</small>
                                </div>

                                {{-- Kapasitas --}}
                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label fw-bold">Kapasitas (orang)</label>
                                    <input
                                        type="number"
                                        name="kapasitas"
                                        id="kapasitas"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        placeholder="Contoh: 2, 4, 6 ..."
                                        value="{{ old('kapasitas') }}"
                                        min="1"
                                        required
                                    >
                                    @error('kapasitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Info QR Code --}}
                                <div class="alert alert-info d-flex align-items-start gap-2">
                                    <i class="fas fa-info-circle mt-1" style="margin-right: 5px;"></i>
                                    <div>
                                        <strong>QR Code otomatis dibuat.</strong><br>
                                        Setelah meja disimpan, QR Code akan di-generate secara otomatis.
                                        Saat pelanggan scan QR, mereka akan diarahkan ke halaman menu meja ini.
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Meja
                                </button>
                                <a href="/admin/meja" class="btn btn-secondary" style="margin-left: 10px;">
                                    Kembali
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
