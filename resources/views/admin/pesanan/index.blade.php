@extends('layouts.admin')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Pesanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Flash messages --}}
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle mr-1"></i> {{ session('sukses') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Semua Pesanan</h3>
                    <div>
                        <span class="badge badge-warning px-2 py-1 mr-1">Menunggu: {{ $pesanan->where('status_pesanan','menunggu')->count() }}</span>
                        <span class="badge badge-primary px-2 py-1 mr-1">Diproses: {{ $pesanan->where('status_pesanan','diproses')->count() }}</span>
                        <span class="badge badge-info px-2 py-1 mr-1">Siap: {{ $pesanan->where('status_pesanan','siap_diambil')->count() }}</span>
                        <span class="badge badge-success px-2 py-1">Selesai: {{ $pesanan->where('status_pesanan','selesai')->count() }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>No. Pesanan</th>
                                <th>PIC (Admin)</th>
                                <th>Meja</th>
                                <th>Menu Dipesan</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status Pesanan</th>
                                <th>Status Bayar</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanan as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="font-weight-bold text-primary">{{ $p->nomor_pesanan }}</td>
                                <td>
                                    @if($p->user)
                                        <span class="badge badge-dark" title="{{ $p->user->nama }}">
                                            <i class="fas fa-user-tie"></i> {{ $p->user->nama }}
                                        </span>
                                    @else
                                        <span class="text-muted small">— Belum ada —</span>
                                    @endif
                                </td>
                                <td>{{ $p->meja ? 'Meja ' . $p->meja->nomor_meja : '-' }}</td>
                                <td>
                                    @foreach($p->detail as $item)
                                        <small>{{ $item->jumlah }}x {{ $item->menu->nama_menu ?? '-' }}</small><br>
                                    @endforeach
                                </td>
                                <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($p->metode_pembayaran) }}</td>
                                <td>
                                    @if($p->status_pesanan === 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($p->status_pesanan === 'diproses')
                                        <span class="badge badge-primary">Diproses</span>
                                    @elseif($p->status_pesanan === 'siap_diambil')
                                        <span class="badge badge-info">Siap Diambil</span>
                                    @else
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status_pembayaran === 'lunas')
                                        <span class="badge badge-success">Lunas</span>
                                    @else
                                        <span class="badge badge-danger">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at->format('d/m H:i') }}</td>
                                <td>
                                    {{-- Tombol Bayar Tunai --}}
                                    @if($p->metode_pembayaran === 'tunai' && $p->status_pembayaran !== 'lunas' && $p->status_pesanan === 'siap_diambil')
                                        <form method="POST" action="/admin/pesanan/bayar/{{ $p->id_pesanan }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-xs"
                                                onclick="return confirm('Konfirmasi pembayaran tunai untuk pesanan {{ $p->nomor_pesanan }}?')">
                                                <i class="fas fa-money-bill-wave"></i> Bayar Tunai
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Tombol Selesaikan (jika siap diambil & sudah bayar) --}}
                                    @if($p->status_pesanan === 'siap_diambil' && $p->status_pembayaran === 'lunas')
                                        <form method="POST" action="/admin/pesanan/selesai/{{ $p->id_pesanan }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-xs">
                                                <i class="fas fa-check"></i> Selesaikan
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Info jika QRIS belum lunas --}}
                                    @if($p->metode_pembayaran === 'qris' && $p->status_pembayaran !== 'lunas')
                                        <span class="badge badge-secondary">Menunggu QRIS</span>
                                    @endif

                                    {{-- Sudah selesai --}}
                                    @if($p->status_pesanan === 'selesai')
                                        @if($p->status_pembayaran === 'lunas')
                                            <!-- Tombol Lihat Struk -->
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#strukModal-{{ $p->id_pesanan }}">
                                                <i class="fas fa-eye"></i> Lihat
                                            </button>

                                            <!-- Modal Struk -->
                                            <div class="modal fade" id="strukModal-{{ $p->id_pesanan }}" tabindex="-1" role="dialog" aria-labelledby="strukModalLabel-{{ $p->id_pesanan }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="strukModalLabel-{{ $p->id_pesanan }}">Struk Pesanan - {{ $p->nomor_pesanan }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-dark" id="printArea-{{ $p->id_pesanan }}">
                                                            <div class="text-center mb-3">
                                                                <h4>Avenoir Kitchen</h4>
                                                                <p class="mb-0">Jalan Restoran No. 123</p>
                                                                <p>Kota, Provinsi</p>
                                                                <hr style="border-top: 1px dashed black;">
                                                            </div>
                                                            <div class="mb-3" style="font-size: 14px;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td>No. Pesanan</td>
                                                                        <td class="text-right">{{ $p->nomor_pesanan }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal</td>
                                                                        <td class="text-right">{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Meja</td>
                                                                        <td class="text-right">{{ $p->meja ? $p->meja->nomor_meja : '-' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kasir</td>
                                                                        <td class="text-right">{{ $p->user ? $p->user->nama : 'Sistem' }}</td>
                                                                    </tr>
                                                                </table>
                                                                <hr style="border-top: 1px dashed black;">
                                                            </div>
                                                            <div class="mb-3" style="font-size: 14px;">
                                                                <table style="width: 100%;">
                                                                    @foreach($p->detail as $item)
                                                                    <tr>
                                                                        <td colspan="2">{{ $item->menu->nama_menu ?? '-' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                                                        <td class="text-right">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                                <hr style="border-top: 1px dashed black;">
                                                            </div>
                                                            <div class="mb-3" style="font-size: 14px;">
                                                                <table style="width: 100%; font-weight: bold;">
                                                                    <tr>
                                                                        <td>Total</td>
                                                                        <td class="text-right">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Metode</td>
                                                                        <td class="text-right">{{ strtoupper($p->metode_pembayaran) }}</td>
                                                                    </tr>
                                                                </table>
                                                                <hr style="border-top: 1px dashed black;">
                                                            </div>
                                                            <div class="text-center" style="font-size: 14px;">
                                                                <p>Terima kasih atas kunjungan Anda!</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="button" class="btn btn-primary" onclick="printStruk('printArea-{{ $p->id_pesanan }}')"><i class="fas fa-print"></i> Print Struk</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">Belum ada pesanan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted small">
                    Total: {{ $pesanan->count() }} pesanan
                </div>
            </div>

        </div>
    </section>

</div>

<script>
function printStruk(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    var printWindow = window.open('', '', 'height=600,width=400');
    printWindow.document.write('<html><head><title>Print Struk</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: monospace; padding: 20px; color: #000; }');
    printWindow.document.write('.text-center { text-align: center; }');
    printWindow.document.write('.text-right { text-align: right; }');
    printWindow.document.write('.mb-3 { margin-bottom: 1rem; }');
    printWindow.document.write('.mb-0 { margin-bottom: 0; }');
    printWindow.document.write('hr { border-top: 1px dashed black; margin: 10px 0; }');
    printWindow.document.write('table { width: 100%; font-size: 14px; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    
    printWindow.document.close();
    printWindow.focus();
    
    // Give it a small delay for styles to load
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 250);
}
</script>

@endsection