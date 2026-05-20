@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/menu">Kelola Menu</a></li>
                        <li class="breadcrumb-item active">Edit Menu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Menu — {{ $menu->nama_menu }}</h3>
                        </div>

                        <form method="POST" action="/admin/menu/{{ $menu->id_menu }}" enctype="multipart/form-data">
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

                                <div class="row">
                                    {{-- Nama Menu --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Menu <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                name="nama_menu"
                                                class="form-control @error('nama_menu') is-invalid @enderror"
                                                value="{{ old('nama_menu', $menu->nama_menu) }}"
                                                required
                                            >
                                            @error('nama_menu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kategori --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                                            <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($kategori as $kat)
                                                    <option value="{{ $kat->id_kategori }}"
                                                        {{ old('id_kategori', $menu->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                                                        {{ $kat->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Harga --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Harga (Rp) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input
                                                    type="number"
                                                    name="harga"
                                                    class="form-control @error('harga') is-invalid @enderror"
                                                    value="{{ old('harga', $menu->harga) }}"
                                                    min="0"
                                                    required
                                                >
                                                @error('harga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status Ketersediaan</label>
                                            <div class="mt-2">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="status_tersedia" name="status_tersedia" value="1"
                                                        {{ old('status_tersedia', $menu->status_tersedia) ? 'checked' : '' }}>
                                                    <label for="status_tersedia">Tersedia</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Deskripsi --}}
                                <div class="form-group">
                                    <label class="font-weight-bold">Deskripsi</label>
                                    <textarea
                                        name="deskripsi"
                                        class="form-control"
                                        rows="3"
                                    >{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                                </div>

                                {{-- Gambar --}}
                                <div class="form-group">
                                    <label class="font-weight-bold">Gambar Makanan</label>
                                    @if($menu->gambar)
                                        <div class="mb-2">
                                            <img src="{{ asset($menu->gambar) }}" alt="Gambar {{ $menu->nama_menu }}" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    @endif
                                    <input
                                        type="file"
                                        name="gambar"
                                        class="form-control-file @error('gambar') is-invalid @enderror"
                                        accept="image/png, image/jpeg, image/jpg"
                                    >
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, JPEG, PNG. Maks: 2MB.</small>
                                    @error('gambar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">
                                    Simpan Perubahan
                                </button>
                                <a href="/admin/menu" class="btn btn-secondary ml-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
