@extends('layouts.koki')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-utensils mr-2"></i> Kitchen Display
                    </h1>
                    <small class="text-muted">Halaman ini menampilkan pesanan yang perlu diproses. Auto-refresh setiap 30 detik.</small>
                </div>
                <div class="col-sm-6 text-right">
                    <span class="badge badge-pill badge-warning px-3 py-2" style="font-size:0.9rem;">
                        <i class="fas fa-clock mr-1"></i> Menunggu: {{ $pesanan->where('status_pesanan', 'menunggu')->count() }}
                    </span>
                    &nbsp;
                    <span class="badge badge-pill badge-primary px-3 py-2" style="font-size:0.9rem;">
                        <i class="fas fa-fire mr-1"></i> Diproses: {{ $pesanan->where('status_pesanan', 'diproses')->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Flash message --}}
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle mr-1"></i> {{ session('sukses') }}
                </div>
            @endif

            {{-- Kosong --}}
            @if($pesanan->isEmpty())
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-coffee fa-4x text-muted mb-3 d-block"></i>
                        <h4 class="text-muted">Tidak ada pesanan aktif saat ini</h4>
                        <p class="text-muted">Halaman akan otomatis refresh ketika ada pesanan baru masuk.</p>
                    </div>
                </div>
            @else

            {{-- ── BAGIAN: MENUNGGU ── --}}
            @php $menunggu = $pesanan->where('status_pesanan', 'menunggu'); @endphp
            @if($menunggu->isNotEmpty())
                <h5 class="mb-3">
                    <span class="badge badge-warning px-2 py-1 mr-2" style="font-size:0.9rem;">MENUNGGU</span>
                    Antrian Baru — Segera Proses!
                </h5>
                <div class="row">
                    @foreach($menunggu as $p)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning" style="border-width: 2px !important;">
                            {{-- Card Header --}}
                            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fas fa-receipt mr-1"></i> {{ $p->nomor_pesanan }}</strong>
                                    <br>
                                    <small>Meja {{ $p->meja ? $p->meja->nomor_meja : '?' }}</small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-dark">MENUNGGU</span>
                                    <br>
                                    <small><i class="fas fa-clock mr-1"></i>{{ $p->created_at->format('H:i') }}</small>
                                </div>
                            </div>

                            {{-- Detail Item --}}
                            <div class="card-body py-2 px-3">
                                <table class="table table-sm table-borderless mb-0">
                                    <tbody>
                                        @foreach($p->detail as $item)
                                        <tr>
                                            <td class="font-weight-bold pl-0" style="width:30px;">{{ $item->jumlah }}x</td>
                                            <td>{{ $item->menu->nama_menu ?? '(menu dihapus)' }}</td>
                                            @if($item->catatan_item)
                                            <td class="text-muted small"><i class="fas fa-sticky-note mr-1"></i>{{ $item->catatan_item }}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if($p->catatan)
                                    <div class="alert alert-light py-1 px-2 mt-1 mb-0 small">
                                        <i class="fas fa-comment-alt mr-1 text-muted"></i> <em>{{ $p->catatan }}</em>
                                    </div>
                                @endif
                            </div>

                            {{-- Action --}}
                            <div class="card-footer bg-transparent pt-2">
                                <form method="POST" action="/koki/kitchen/mulai/{{ $p->id_pesanan }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-block font-weight-bold">
                                        <i class="fas fa-fire mr-1"></i> Mulai Masak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            {{-- ── SEPARATOR ── --}}
            @if($menunggu->isNotEmpty() && $pesanan->where('status_pesanan','diproses')->isNotEmpty())
                <hr class="my-2">
            @endif

            {{-- ── BAGIAN: DIPROSES ── --}}
            @php $diproses = $pesanan->where('status_pesanan', 'diproses'); @endphp
            @if($diproses->isNotEmpty())
                <h5 class="mb-3 mt-3">
                    <span class="badge badge-primary px-2 py-1 mr-2" style="font-size:0.9rem;">DIMASAK</span>
                    Sedang Diproses di Dapur
                </h5>
                <div class="row">
                    @foreach($diproses as $p)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-primary" style="border-width: 2px !important;">
                            {{-- Card Header --}}
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fas fa-receipt mr-1"></i> {{ $p->nomor_pesanan }}</strong>
                                    <br>
                                    <small>Meja {{ $p->meja ? $p->meja->nomor_meja : '?' }}</small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-light text-primary">DIMASAK</span>
                                    <br>
                                    <small><i class="fas fa-clock mr-1"></i>{{ $p->created_at->format('H:i') }}</small>
                                </div>
                            </div>

                            {{-- Detail Item --}}
                            <div class="card-body py-2 px-3">
                                <table class="table table-sm table-borderless mb-0">
                                    <tbody>
                                        @foreach($p->detail as $item)
                                        <tr>
                                            <td class="font-weight-bold pl-0" style="width:30px;">{{ $item->jumlah }}x</td>
                                            <td>{{ $item->menu->nama_menu ?? '(menu dihapus)' }}</td>
                                            @if($item->catatan_item)
                                            <td class="text-muted small"><i class="fas fa-sticky-note mr-1"></i>{{ $item->catatan_item }}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if($p->catatan)
                                    <div class="alert alert-light py-1 px-2 mt-1 mb-0 small">
                                        <i class="fas fa-comment-alt mr-1 text-muted"></i> <em>{{ $p->catatan }}</em>
                                    </div>
                                @endif
                            </div>

                            {{-- Action --}}
                            <div class="card-footer bg-transparent pt-2">
                                <form method="POST" action="/koki/kitchen/selesai/{{ $p->id_pesanan }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block font-weight-bold">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai — Siap Diambil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            @endif
            {{-- end if $pesanan --}}

        </div>
    </section>

</div>

{{-- Auto-refresh setiap 30 detik --}}
<script>
    setTimeout(function () {
        window.location.reload();
    }, 30000);
</script>
@endsection