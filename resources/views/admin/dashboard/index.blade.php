@extends('layouts.admin')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- ── DETAIL PESANAN + KATEGORI MENU ── --}}
            <div class="row">

                {{-- Tabel Detail Pesanan --}}
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Detail Pesanan</h3>
                            <a href="/admin/pesanan" class="btn btn-sm btn-outline-primary">Lihat Pesanan</a>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Pesanan</th>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($detailPesanan as $detail)
                                    <tr>
                                        <td><span class="text-primary font-weight-bold">{{ $detail->pesanan->nomor_pesanan ?? '-' }}</span></td>
                                        <td>{{ $detail->menu->nama_menu ?? '-' }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        <td>
                                            @if(($detail->pesanan->status_pesanan ?? '') === 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif(($detail->pesanan->status_pesanan ?? '') === 'diproses')
                                                <span class="badge badge-primary">Diproses</span>
                                            @elseif(($detail->pesanan->status_pesanan ?? '') === 'siap_diambil')
                                                <span class="badge badge-info">Siap Diambil</span>
                                            @elseif(($detail->pesanan->status_pesanan ?? '') === 'selesai')
                                                <span class="badge badge-success">Selesai</span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>{{ optional($detail->created_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">Belum ada detail pesanan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Tabel Kategori Menu --}}
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Kategori Menu</h3>
                            <a href="/admin/menu" class="btn btn-sm btn-outline-primary">Lihat Menu</a>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Jumlah Menu</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kategoriMenu as $kategori)
                                    <tr>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td><span class="badge badge-info">{{ $kategori->menus_count }} menu</span></td>
                                        <td>{{ optional($kategori->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">Belum ada kategori menu</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection