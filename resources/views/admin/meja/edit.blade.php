@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Meja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/meja">Kelola Meja</a></li>
                        <li class="breadcrumb-item active">Edit Meja</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Meja — Meja {{ $meja->nomor_meja }}</h3>
                        </div>

                        <form method="POST" action="/admin/meja/{{ $meja->id_meja }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="nomor_meja" class="font-weight-bold">Nomor Meja</label>
                                    <input
                                        type="number"
                                        name="nomor_meja"
                                        id="nomor_meja"
                                        class="form-control @error('nomor_meja') is-invalid @enderror"
                                        value="{{ old('nomor_meja', $meja->nomor_meja) }}"
                                        min="1"
                                        required
                                    >
                                    @error('nomor_meja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Nomor meja harus unik.</small>
                                </div>

                                <div class="form-group">
                                    <label for="kapasitas" class="font-weight-bold">Kapasitas (orang)</label>
                                    <input
                                        type="number"
                                        name="kapasitas"
                                        id="kapasitas"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        value="{{ old('kapasitas', $meja->kapasitas) }}"
                                        min="1"
                                        required
                                    >
                                    @error('kapasitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Info QR --}}
                                <div class="callout callout-info">
                                    <h6><i class="fas fa-info-circle mr-1"></i> Info QR Code</h6>
                                    <p class="mb-0 small">
                                        QR Code tidak akan berubah saat mengedit meja karena tetap merujuk ke
                                        <code>id_meja</code> yang sama ({{ $meja->id_meja }}).
                                    </p>
                                </div>

                                {{-- Preview QR --}}
                                @if($meja->qr_code)
                                <div class="text-center mt-2">
                                    <img src="{{ asset($meja->qr_code) }}" alt="QR Meja {{ $meja->nomor_meja }}" style="width:120px;height:120px;">
                                    <p class="small text-muted mt-1">QR Code saat ini</p>
                                </div>
                                @endif

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">
                                    Simpan Perubahan
                                </button>
                                <a href="/admin/meja" class="btn btn-secondary ml-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
