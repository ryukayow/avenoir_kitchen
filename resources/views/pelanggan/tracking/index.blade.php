<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Tracking Pesanan - Avenoir Kitchen</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
</head>
<body>

  <div class="hero_area" style="min-height: auto;">
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="{{ route('landing.index') }}">
            <span style="background-color: #0000009e; border-radius: 50px; padding: 5px 10px;">
              <img src="{{ asset('assets/logo/logoavenoir-removebg-preview.png') }}" alt="logo avenoir" style="width: 50px;">
              Avenoir Kitchen
            </span>
          </a>
        </nav>
      </div>
    </header>
  </div>

  <section class="layout_padding">
    <div class="container">

      <div class="heading_container heading_center">
        <h2>Status Pesanan</h2>
        <p class="text-muted">Lacak pesanan kamu secara langsung</p>
      </div>

      {{-- Info Nomor Pesanan --}}
      <div class="row justify-content-center mb-4">
        <div class="col-md-8">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <h6 class="text-muted mb-1">Nomor Pesanan</h6>
              <h4 class="font-weight-bold" style="color: #e8b842;">{{ $pesanan->nomor_pesanan }}</h4>
              <p class="text-muted small mb-0">
                <i class="fa fa-calendar mr-1"></i>
                {{ $pesanan->created_at->format('d M Y, H:i') }} WIB
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- Timeline Status --}}
      <div class="row justify-content-center mb-4">
        <div class="col-md-10">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="mb-0"><i class="fa fa-map-marker mr-2" style="color:#e8b842;"></i>Perjalanan Pesanan</h5>
            </div>
            <div class="card-body">

              @php
                $statusList = [
                  'menunggu'     => ['icon' => 'fa-clock-o',   'label' => 'Menunggu',    'desc' => 'Pesanan kamu masuk dan menunggu antrian dapur.'],
                  'diproses'     => ['icon' => 'fa-fire',      'label' => 'Dimasak',     'desc' => 'Koki sedang menyiapkan pesananmu dengan penuh semangat!'],
                  'siap_diambil' => ['icon' => 'fa-check-circle', 'label' => 'Siap Diambil', 'desc' => 'Pesananmu sudah siap! Silakan ambil di kasir.'],
                  'selesai'      => ['icon' => 'fa-smile-o',   'label' => 'Selesai',     'desc' => 'Pesanan selesai. Selamat menikmati! 😊'],
                ];
                $urutan = array_keys($statusList);
                $indexAktif = array_search($pesanan->status_pesanan, $urutan);
              @endphp

              <div class="row text-center">
                @foreach($statusList as $key => $info)
                  @php
                    $idx = array_search($key, $urutan);
                    $sudahLewat = $idx < $indexAktif;
                    $aktif = $idx === $indexAktif;
                    $belumTiba = $idx > $indexAktif;
                  @endphp
                  <div class="col-3">
                    <div class="mb-2">
                      <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x"
                           style="color: {{ $aktif ? '#e8b842' : ($sudahLewat ? '#28a745' : '#dee2e6') }};"></i>
                        <i class="fa {{ $info['icon'] }} fa-stack-1x fa-inverse"></i>
                      </span>
                    </div>
                    <div class="font-weight-bold small {{ $aktif ? '' : ($sudahLewat ? 'text-success' : 'text-muted') }}">
                      {{ $info['label'] }}
                    </div>
                    @if($aktif)
                      <small class="text-muted">{{ $info['desc'] }}</small>
                    @endif
                  </div>
                @endforeach
              </div>

            </div>
          </div>
        </div>
      </div>

      {{-- Detail Pesanan --}}
      <div class="row justify-content-center mb-4">
        <div class="col-md-10">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="fa fa-list mr-2" style="color:#e8b842;"></i>Detail Pesanan</h5>
              <div>
                @if($pesanan->status_pesanan === 'menunggu')
                  <span class="badge badge-warning px-2 py-1">Menunggu</span>
                @elseif($pesanan->status_pesanan === 'diproses')
                  <span class="badge badge-primary px-2 py-1">Dimasak</span>
                @elseif($pesanan->status_pesanan === 'siap_diambil')
                  <span class="badge badge-info px-2 py-1">Siap Diambil</span>
                @else
                  <span class="badge badge-success px-2 py-1">Selesai</span>
                @endif
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>Menu</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pesanan->detail as $item)
                  <tr>
                    <td>
                      {{ $item->menu->nama_menu ?? '(menu dihapus)' }}
                      @if($item->catatan_item)
                        <br><small class="text-muted"><i class="fa fa-sticky-note mr-1"></i>{{ $item->catatan_item }}</small>
                      @endif
                    </td>
                    <td class="text-center">{{ $item->jumlah }}x</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                    <td class="text-right font-weight-bold" style="color:#e8b842;">
                      Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <span>
                <i class="fa fa-credit-card mr-1 text-muted"></i>
                Metode: <strong>{{ ucfirst($pesanan->metode_pembayaran) }}</strong>
              </span>
              <span>
                Status Bayar:
                @if($pesanan->status_pembayaran === 'lunas')
                  <span class="badge badge-success">Lunas</span>
                @else
                  <span class="badge badge-danger">Belum Bayar</span>
                @endif
              </span>
            </div>
          </div>
        </div>
      </div>

      {{-- Catatan --}}
      @if($pesanan->catatan)
      <div class="row justify-content-center mb-4">
        <div class="col-md-10">
          <div class="alert alert-light">
            <i class="fa fa-comment mr-2 text-muted"></i>
            <strong>Catatan:</strong> {{ $pesanan->catatan }}
          </div>
        </div>
      </div>
      @endif

      {{-- Tombol kembali ke menu --}}
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          @if($pesanan->meja)
            <a href="/menu/{{ $pesanan->id_meja }}" class="btn btn-warning font-weight-bold px-4">
              <i class="fa fa-cutlery mr-2"></i>Pesan Lagi
            </a>
          @endif
        </div>
      </div>

    </div>
  </section>

  <footer class="footer_section">
    <div class="container">
      <p>&copy; <span id="displayYear"></span> Avenoir Kitchen &mdash; Kelompok 7</p>
    </div>
  </footer>

  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    document.getElementById('displayYear').textContent = new Date().getFullYear();
  </script>

</body>
</html>
