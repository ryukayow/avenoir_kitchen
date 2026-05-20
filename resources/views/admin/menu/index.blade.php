@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kelola Menu</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Tabel Menu</h3>
                    <a href="/admin/menu/create" class="btn btn-primary btn-sm">+ Tambah Menu</a>
                </div>
                <div class="card-body">

                @if(session('sukses'))
                    <div class="alert alert-success">{{ session('sukses') }}</div>
                @endif

                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Id Menu</th>
                      <th>Id Kategori</th>
                      <th>Nama Menu</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Gambar Menu</th>
                      <th>Status Ketersediaan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($menu as $m)
                    <tr>
                      <td>{{ $m->id_menu }}</td>
                      <td>{{ $m->id_kategori }}</td>
                      <td>{{ $m->nama_menu }}</td>
                      <td>{{ $m->deskripsi }}</td>
                      <td>Rp {{ number_format($m->harga, 0, ',', '.') }}</td>
                      <td class="text-center">
                        @if($m->gambar)
                          <img src="{{ asset($m->gambar) }}" alt="{{ $m->nama_menu }}" style="max-width: 80px; max-height: 80px; object-fit: cover; border-radius: 5px;">
                        @else
                          <span class="text-muted small">Tidak ada</span>
                        @endif
                      </td>
                      <td>
                        @if($m->status_tersedia)
                          <span class="badge bg-success">Tersedia</span>
                        @else
                          <span class="badge bg-danger">Habis</span>
                        @endif
                      </td>
                      <td>
                        <a href="/admin/menu/{{ $m->id_menu }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="/admin/menu/{{ $m->id_menu }}" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Hapus menu {{ $m->nama_menu }}?')">
                            Hapus
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </section>

  </div>
  @endsection