@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kelola Meja</h1>
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
                    <h3 class="mb-0">Tabel Kelola Meja</h3>
                    <a href="/admin/meja/create" class="btn btn-primary btn-sm">+ Tambah Meja</a>
                </div>
                <div class="card-body">

                @if(session('sukses'))
                    <div class="alert alert-success">{{ session('sukses') }}</div>
                @endif

                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Id Meja</th>
                      <th>Nomor Meja</th>
                      <th>Kapasitas</th>
                      <th>QR Code</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($meja as $m)
                    <tr>
                      <td>{{ $m->id_meja }}</td>
                      <td>Meja {{ $m->nomor_meja }}</td>
                      <td>{{ $m->kapasitas }} orang</td>
                      <td>
                        @if($m->qr_code)
                          {{-- Tampilkan gambar QR Code --}}
                          <img src="{{ asset($m->qr_code) }}"
                               alt="QR Meja {{ $m->nomor_meja }}"
                               style="width: 80px; height: 80px; cursor: pointer;"
                               title="Scan untuk ke menu Meja {{ $m->nomor_meja }}">
                        @else
                          <span class="badge bg-secondary">Belum ada QR</span>
                        @endif
                      </td>
                      <td>
                        @if($m->status === 'terisi')
                          <span class="badge bg-danger">Terisi</span>
                        @else
                          <span class="badge bg-success">Kosong</span>
                        @endif
                      </td>
                      <td>
                        <a href="/menu/{{ $m->id_meja }}" target="_blank" class="btn btn-sm btn-info">Lihat Menu</a>
                        <a href="/admin/meja/{{ $m->id_meja }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="/admin/meja/{{ $m->id_meja }}" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Hapus meja {{ $m->nomor_meja }}?')">
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