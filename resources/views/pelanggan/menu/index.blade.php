<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Menu - Avenoir Kitchen | Meja {{ $meja->nomor_meja }}</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- font awesome style -->
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
</head>

<body>

  <div class="hero_area" style="min-height: auto;">

    <!-- header section -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="{{ route('landing.index') }}">
            <span style="background-color: #0000009e; border-radius: 50px; padding: 5px 10px;">
              <img src="{{ asset('assets/logo/logoavenoir-removebg-preview.png') }}" alt="logo avenoir" style="width: 50px;">
              Avenoir Kitchen
            </span>
          </a>
          <div class="ml-auto d-flex align-items-center" style="margin-right: 75px;">
            <a href="{{ route('landing.index') }}" class="btn btn-outline-dark btn-sm mr-4 font-weight-bold" style="border-radius: 20px;">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Beranda
            </a>
            <span class="text-dark font-weight-bold">
              <i class="fa fa-cutlery" aria-hidden="true"></i>
              &nbsp;Meja {{ $meja->nomor_meja }}
            </span>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

  </div>
  <!-- end hero_area -->


  <!-- food section -->
  <section class="food_section layout_padding">
    <div class="container">

      <div class="heading_container heading_center">
        <h2>Pilih Menu Kamu</h2>
        <p class="text-muted">Pesan langsung dari meja, kami siapkan dengan sepenuh hati</p>
      </div>

      <!-- Tab Kategori -->
      <ul class="filters_menu list-inline mb-4 text-center">
        <li class="list-inline-item active" data-filter="semua" onclick="filterKat('semua', this)">Semua</li>
        @foreach($kategori as $kat)
          <li class="list-inline-item" data-filter="kat-{{ $kat->id_kategori }}" onclick="filterKat('kat-{{ $kat->id_kategori }}', this)">
            {{ $kat->nama_kategori }}
          </li>
        @endforeach
      </ul>

      <!-- Loop tiap kategori -->
      @foreach($kategori as $kat)
        <div class="kategori-section mb-5" data-kat="kat-{{ $kat->id_kategori }}">

          <h4 class="mb-3" style="border-bottom: 2px solid #e8b842; display:inline-block; padding-bottom:4px;">
            {{ $kat->nama_kategori }}
          </h4>

          @if($kat->menus->isEmpty())
            <p class="text-muted">Belum ada menu tersedia di kategori ini.</p>
          @else
            <div class="row">
              @foreach($kat->menus as $menu)
              <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">

                  {{-- Gambar menu --}}
                  @if($menu->gambar && file_exists(public_path($menu->gambar)))
                    <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height:180px;object-fit:cover;">
                  @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:180px;">
                      <i class="fa fa-cutlery fa-3x text-white-50"></i>
                    </div>
                  @endif

                  <div class="card-body d-flex flex-column">
                    <h6 class="card-title font-weight-bold">{{ $menu->nama_menu }}</h6>
                    <p class="card-text text-muted small flex-grow-1">{{ $menu->deskripsi ?? '' }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                      <strong style="color:#e8b842;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</strong>
                      <button class="btn btn-warning btn-sm font-weight-bold"
                        onclick="tambahKeranjang({{ $menu->id_menu }}, '{{ addslashes($menu->nama_menu) }}', {{ $menu->harga }}, this)">
                        + Pesan
                      </button>
                    </div>
                  </div>

                </div>
              </div>
              @endforeach
            </div>
          @endif

        </div>
      @endforeach

    </div>
  </section>
  <!-- end food section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Avenoir Kitchen &mdash; Kelompok 7
      </p>
    </div>
  </footer>
  <!-- end footer section -->


  <!-- ─── CART BAR STICKY BOTTOM ─── -->
  <div id="cart-bar" class="bg-dark border-top border-warning py-3 px-4"
       style="position:fixed;bottom:0;left:0;right:0;z-index:999;display:none;">
    <div class="d-flex justify-content-between align-items-center">
      <div class="text-white">
        <i class="fa fa-shopping-basket text-warning"></i>
        &nbsp;<span id="cart-count" class="text-warning font-weight-bold">0</span> item
        &nbsp;&mdash;&nbsp; Total: <span id="cart-total" class="text-warning font-weight-bold">Rp 0</span>
      </div>
      <button class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#modalKeranjang">
        Lihat Keranjang
      </button>
    </div>
  </div>


  <!-- ─── MODAL KERANJANG ─── -->
  <div class="modal fade" id="modalKeranjang" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa fa-shopping-basket text-warning"></i> &nbsp;Keranjang Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div id="cart-items-list">
            <p class="text-muted text-center">Keranjang kosong</p>
          </div>

          <hr>
          <div class="d-flex justify-content-between font-weight-bold">
            <span>Total Pembayaran</span>
            <span id="modal-total" class="text-warning">Rp 0</span>
          </div>

          <div class="form-group mt-3">
            <label for="catatan" class="small text-muted">Catatan (opsional)</label>
            <textarea id="catatan" class="form-control" rows="2" placeholder="Contoh: tidak pedas, tanpa bawang..."></textarea>
          </div>

          <div class="form-group">
            <label for="metode_pembayaran" class="small text-muted">Metode Pembayaran</label>
            <select id="metode_pembayaran" class="form-control">
              <option value="tunai">Tunai (bayar di kasir)</option>
              <option value="qris">QRIS (bayar sekarang)</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
          <button class="btn btn-warning font-weight-bold" id="btn-pesan" onclick="kirimPesanan()">
            Pesan Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>


  <!-- ─── MODAL SUKSES ─── -->
  <div class="modal fade" id="modalSukses" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <h5 class="text-warning font-weight-bold">Pesanan Berhasil!</h5>
        <p id="sukses-nomor" class="text-muted small"></p>
        <p class="text-muted small">Pesanan kamu sedang kami proses. Terima kasih!</p>
        <a id="link-tracking" href="#" class="btn btn-warning font-weight-bold mt-2">
          Lacak Pesanan
        </a>
      </div>
    </div>
  </div>


  <!-- ─── MODAL QR CODE TUNAI ─── -->
  <div class="modal fade" id="modalQRIS" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">

        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title w-100 font-weight-bold text-dark" id="qr-modal-title">
            <i class="fa fa-qrcode text-warning"></i>&nbsp; Pembayaran QRIS
          </h5>
        </div>

        <div class="modal-body">
          <p class="text-muted small mb-1">Scan QR Code di bawah ini untuk melakukan pembayaran</p>
          <p id="qr-nomor-pesanan" class="font-weight-bold text-dark mb-3" style="font-size:13px;"></p>

          <!-- QR Code SVG -->
          <div class="d-flex justify-content-center mb-3">
            <div style="border: 3px solid #e8b842; border-radius: 12px; padding: 16px; display: inline-block; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
              <img src="{{ asset('assets/qrcode/qrcod.png') }}" alt="QR Code Pembayaran" style="width: 200px; height: 200px; display: block;">
            </div>
          </div>

          <p id="qr-total-harga" class="font-weight-bold text-warning" style="font-size: 1.2rem;"></p>
          <div id="qr-modal-desc">
            <p class="text-muted small mb-0">Tunjukkan QR Code ini kepada kasir</p>
            <p class="text-muted small">Kasir akan mengkonfirmasi pembayaran Anda</p>
          </div>
        </div>

        <div class="modal-footer border-0 justify-content-center">
          <button class="btn btn-warning font-weight-bold px-5" id="btn-selesai-qr" onclick="selesaiPembayaran()">
            <i class="fa fa-check-circle"></i>&nbsp; Selesai
          </button>
        </div>

      </div>
    </div>
  </div>


  <!-- jQuery -->
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <!-- custom js -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script>
    // ─── Tahun footer ───
    document.getElementById('displayYear').textContent = new Date().getFullYear();

    // ─── Data keranjang ───
    let keranjang = [];
    const ID_MEJA = {{ $meja->id_meja }};

    // ─── Filter kategori ───
    function filterKat(target, el) {
      document.querySelectorAll('.filters_menu li').forEach(li => li.classList.remove('active'));
      el.classList.add('active');
      document.querySelectorAll('.kategori-section').forEach(sec => {
        sec.style.display = (target === 'semua' || sec.dataset.kat === target) ? '' : 'none';
      });
    }

    // ─── Tambah ke keranjang ───
    function tambahKeranjang(id_menu, nama, harga, btn) {
      const idx = keranjang.findIndex(i => i.id_menu === id_menu);
      if (idx >= 0) {
        keranjang[idx].jumlah++;
      } else {
        keranjang.push({ id_menu, nama, harga, jumlah: 1 });
      }
      updateUI();
      btn.textContent = '✓ Ditambah';
      setTimeout(() => btn.textContent = '+ Pesan', 900);
    }

    // ─── Ubah jumlah ───
    function ubahJumlah(id_menu, delta) {
      const idx = keranjang.findIndex(i => i.id_menu === id_menu);
      if (idx < 0) return;
      keranjang[idx].jumlah += delta;
      if (keranjang[idx].jumlah <= 0) keranjang.splice(idx, 1);
      updateUI();
      renderModal();
    }

    // ─── Update UI bar bawah ───
    function updateUI() {
      const total = keranjang.reduce((s, i) => s + i.harga * i.jumlah, 0);
      const count = keranjang.reduce((s, i) => s + i.jumlah, 0);
      document.getElementById('cart-count').textContent = count;
      document.getElementById('cart-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
      document.getElementById('modal-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
      document.getElementById('cart-bar').style.display = count > 0 ? '' : 'none';
    }

    // ─── Render isi modal ───
    function renderModal() {
      const container = document.getElementById('cart-items-list');
      if (keranjang.length === 0) {
        container.innerHTML = '<p class="text-muted text-center">Keranjang kosong</p>';
        return;
      }
      container.innerHTML = keranjang.map(item => `
        <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
          <div>
            <div class="font-weight-bold small">${item.nama}</div>
            <div class="text-warning small">Rp ${item.harga.toLocaleString('id-ID')}</div>
          </div>
          <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="ubahJumlah(${item.id_menu}, -1)">−</button>
            <span class="mx-2 font-weight-bold">${item.jumlah}</span>
            <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="ubahJumlah(${item.id_menu}, 1)">+</button>
          </div>
        </div>
      `).join('');
      updateUI();
    }

    // Render saat modal dibuka
    $('#modalKeranjang').on('show.bs.modal', renderModal);

    // ─── Kirim pesanan ───
    async function kirimPesanan() {
      if (keranjang.length === 0) return;
      const btn = document.getElementById('btn-pesan');
      btn.disabled = true;
      btn.textContent = 'Memproses...';

      const payload = {
        id_meja: ID_MEJA,
        metode_pembayaran: document.getElementById('metode_pembayaran').value,
        catatan: document.getElementById('catatan').value,
        items: keranjang.map(i => ({ id_menu: i.id_menu, jumlah: i.jumlah, catatan_item: null })),
        _token: '{{ csrf_token() }}'
      };

      try {
        const res = await fetch('/pesan', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success) {
          $('#modalKeranjang').modal('hide');

          const total = keranjang.reduce((s, i) => s + i.harga * i.jumlah, 0);
          keranjang = [];
          updateUI();

          // Tampilkan modal QR Code untuk semua metode pembayaran (tunai & qris)
          if (payload.metode_pembayaran === 'tunai') {
            document.getElementById('qr-modal-title').innerHTML = '<i class="fa fa-qrcode text-warning"></i>&nbsp; Pembayaran Tunai';
            document.getElementById('qr-modal-desc').innerHTML = '<p class="text-muted small mb-0">Tunjukkan QR Code ini kepada kasir</p><p class="text-muted small">Kasir akan mengkonfirmasi pembayaran Anda</p>';
          } else {
            document.getElementById('qr-modal-title').innerHTML = '<i class="fa fa-qrcode text-warning"></i>&nbsp; Pembayaran QRIS';
            document.getElementById('qr-modal-desc').innerHTML = '<p class="text-muted small mb-0">Silahkan scan qr code tersebut</p><p class="text-muted small">lalu lakukan pembayaran di aplikasi qris anda</p>';
          }

          document.getElementById('qr-nomor-pesanan').textContent = 'No. Pesanan: ' + data.nomor_pesanan;
          document.getElementById('qr-total-harga').textContent = 'Total: Rp ' + total.toLocaleString('id-ID');
          // Simpan nomor pesanan untuk redirect setelah selesai
          document.getElementById('btn-selesai-qr').dataset.nomorPesanan = data.nomor_pesanan;
          $('#modalQRIS').modal('show');
        } else {
          alert('Gagal membuat pesanan. Coba lagi.');
        }
      } catch (e) {
        alert('Terjadi kesalahan koneksi.');
      } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-paper-plane"></i> Pesan Sekarang';
      }
    }

    // ─── Selesai bayar QRIS → redirect ke tracking ───
    function selesaiPembayaran() {
      const btn = document.getElementById('btn-selesai-qr');
      const nomorPesanan = btn.dataset.nomorPesanan;
      $('#modalQRIS').modal('hide');
      window.location.href = '/tracking/' + nomorPesanan;
    }
  </script>

</body>

</html>
