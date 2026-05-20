<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="restoran, mie ayam, spaghetti, avenoir kitchen, kuliner" />
  <meta name="description" content="Avenoir Kitchen - Restoran premium dengan Mie Ayam dan Spaghetti terbaik di Margahayu" />
  <meta name="author" content="Kelompok 7" />

  <title>Avenoir Kitchen</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
</head>

<body>

  <div class="hero_area" id="hero">

    {{-- ─── NAVBAR ─── --}}
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">

          <a class="navbar-brand" href="{{ route('landing.index') }}">
            <span style="background-color:#0000009e;border-radius:50px;padding:5px 10px;">
              <img src="{{ asset('assets/logo/logoavenoir-removebg-preview.png') }}" alt="logo avenoir" style="width:50px;">
              Avenoir Kitchen
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navLinks" aria-controls="navLinks" aria-expanded="false" style="border: none; outline: none;">
            <i class="fa fa-bars" style="color: #000; font-size: 28px;"></i>
          </button>

          <div class="collapse navbar-collapse" id="navLinks">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link" href="#hero" style="color: #000000 !important;">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#menu" style="color: #000000 !important;">Menu</a></li>
              <li class="nav-item"><a class="nav-link" href="#cara-pesan" style="color: #000000 !important;">Cara Pesan</a></li>
              <li class="nav-item"><a class="nav-link" href="#about" style="color: #000000 !important;">Tentang Kami</a></li>
              <li class="nav-item"><a class="nav-link" href="#testimonial" style="color: #000000 !important;">Testimonial</a></li>
            </ul>
            <div class="User_option ml-3">
              <a href="{{ route('login') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                Login
              </a>
            </div>
          </div>

        </nav>
      </div>
    </header>
    {{-- ─── END NAVBAR ─── --}}

    {{-- ─── HERO SLIDER ─── --}}
    <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="detail-box">
              <h1>
                Selamat Datang di <br> Avenoir Kitchen
              </h1>
              <p>
                Nikmati sajian terbaik &mdash; Mie Ayam &amp; Spaghetti dengan cita rasa autentik, kualitas nomor satu.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="slider_container">
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778374972_Mie_Ayam-removebg-preview.png') }}" alt="Mie Ayam" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375026_spaghetti-removebg-preview.png') }}" alt="Spaghetti" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375043_Shrimp_Tempura-removebg-preview.png') }}" alt="Shrimp Tempura" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375057_soup_cream-removebg-preview.png') }}" alt="Soup Cream" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375081_sushi-removebg-preview.png') }}" alt="Sushi" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375149_teh_manis-removebg-preview.png') }}" alt="Teh Manis" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375168_ocha-removebg-preview.png') }}" alt="Ocha" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375190_mangga-removebg-preview.png') }}" alt="Mangga" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778374972_Mie_Ayam-removebg-preview.png') }}" alt="Mie Ayam" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375026_spaghetti-removebg-preview.png') }}" alt="Spaghetti" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375043_Shrimp_Tempura-removebg-preview.png') }}" alt="Shrimp Tempura" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="{{ asset('assets/img/menu/1778375057_soup_cream-removebg-preview.png') }}" alt="Soup Cream" />
          </div>
        </div>
      </div>
    </section>

  </div>



  {{-- ─── MENU SECTION ─── --}}
  <section class="recipe_section layout_padding-top" id="menu">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Menu Populer Kami</h2>
      </div>
      <div class="row">

        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('assets/img/menuu/Mie Ayam.jfif') }}" class="box-img" alt="Food">
            </div>
            <div class="detail-box">
              <h4>Food</h4>
              <a href="#cara-pesan">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('assets/img/menuu/Shrimp Tempura.jfif') }}" class="box-img" alt="Side Dish">
            </div>
            <div class="detail-box">
              <h4>Side Dish</h4>
              <a href="#cara-pesan">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('assets/img/menuu/ocha.jfif') }}" class="box-img" alt="Drink" style="width:360px;height:360px;object-fit:cover;">
            </div>
            <div class="detail-box">
              <h4>Drink</h4>
              <a href="#cara-pesan">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>

      </div>
      <div class="btn-box">
        <a href="#cara-pesan">
          Pesan Sekarang
        </a>
      </div>
    </div>
  </section>
  {{-- ─── END MENU SECTION ─── --}}


  {{-- ─── CARA PESAN SECTION (menggantikan app_section) ─── --}}
  <section class="app_section" id="cara-pesan">
    <div class="container">
      <div class="col-md-10 mx-auto">
        <div class="row align-items-center">

          <div class="col-md-7 col-lg-8">
            <div class="detail-box">
              <h2>
                <span>Cara</span> <br>
                Memesan di Avenoir Kitchen
              </h2>
              <p>
                Pesan makanan favoritmu langsung dari meja, mudah dan cepat. Tidak perlu antri di kasir!
              </p>

              <div class="row mt-4 text-center">
                <div class="col-4">
                  <i class="fa fa-qrcode fa-3x mb-2" aria-hidden="true"></i>
                  <p><strong>1. Scan QR</strong></p>
                  <small>Scan QR Code di atas meja Anda</small>
                </div>
                <div class="col-4">
                  <i class="fa fa-cutlery fa-3x mb-2" aria-hidden="true"></i>
                  <p><strong>2. Pilih Menu</strong></p>
                  <small>Pilih menu &amp; masukkan ke keranjang</small>
                </div>
                <div class="col-4">
                  <i class="fa fa-smile-o fa-3x mb-2" aria-hidden="true"></i>
                  <p><strong>3. Tunggu &amp; Nikmati</strong></p>
                  <small>Pesanan diantarkan ke meja Anda</small>
                </div>
              </div>

              <div class="mt-4">
                <a href="#" class="download_btn">
                  <i class="fa fa-qrcode mr-2" aria-hidden="true"></i>
                  Silakan Scan QR di Meja Anda
                </a>
              </div>

            </div>
          </div>

          <div class="col-md-5 col-lg-4 text-center">
            <div class="img-box">
              <img src="{{ asset('assets/img/menu/1778374972_Mie_Ayam-removebg-preview.png') }}" class="box-img" alt="Mie Ayam">
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  {{-- ─── END CARA PESAN ─── --}}


  {{-- ─── ABOUT SECTION ─── --}}
  <section class="about_section layout_padding" id="about">
    <div class="container">
      <div class="col-md-11 col-lg-10 mx-auto">
        <div class="heading_container heading_center">
          <h2>Tentang Kami</h2>
        </div>
        <div class="box">
          <div class="col-md-7 mx-auto">
            <div class="img-box">
              <img src="{{ asset('assets/images/about-img.jpg') }}" class="box-img" alt="Avenoir Kitchen">
            </div>
          </div>
          <div class="detail-box">
            <p>
              Avenoir Kitchen hadir sebagai restoran premium yang mengangkat cita rasa autentik melalui dua hidangan utama: Mie Ayam dan Spaghetti.
              <br><br>
              Berbeda dengan restoran pada umumnya, kami menetapkan standar tertinggi untuk bahan baku dasar kami. Setiap helai mie yang kami gunakan diproses dengan resep eksklusif untuk menghasilkan tekstur kenyal sempurna yang tidak akan Anda temukan di tempat lain.
              <br><br>
              Avenoir Kitchen bukan sekadar tempat makan, melainkan pengalaman kuliner kelas atas yang bisa Anda nikmati setiap hari.
            </p>
            <a href="#menu">
              <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- ─── END ABOUT ─── --}}


  {{-- ─── GALERI MENU (horizontal scroll, CSS only) ─── --}}
  <section class="news_section" id="gallery">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Galeri Menu</h2>
      </div>
      <div style="display:flex;overflow-x:auto;gap:20px;padding-bottom:16px;">

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778374972_Mie_Ayam-removebg-preview.png') }}" alt="Mie Ayam" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Mie Ayam</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375026_spaghetti-removebg-preview.png') }}" alt="Spaghetti" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Spaghetti</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375043_Shrimp_Tempura-removebg-preview.png') }}" alt="Shrimp Tempura" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Shrimp Tempura</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375057_soup_cream-removebg-preview.png') }}" alt="Soup Cream" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Soup Cream</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375081_sushi-removebg-preview.png') }}" alt="Sushi" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Sushi</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375149_teh_manis-removebg-preview.png') }}" alt="Teh Manis" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Teh Manis</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375168_ocha-removebg-preview.png') }}" alt="Ocha" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Ocha</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375190_mangga-removebg-preview.png') }}" alt="Jus Mangga" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Jus Mangga</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375204_alpukat-removebg-preview.png') }}" alt="Jus Alpukat" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Jus Alpukat</p>
        </div>

        <div style="min-width:200px;flex-shrink:0;text-align:center;">
          <img src="{{ asset('assets/img/menu/1778375218_stroberi-removebg-preview.png') }}" alt="Jus Stroberi" style="height:160px;object-fit:contain;">
          <p class="font-weight-bold mt-2">Jus Stroberi</p>
        </div>

      </div>
    </div>
  </section>
  {{-- ─── END GALERI MENU ─── --}}


  {{-- ─── TESTIMONIAL ─── --}}
  <section class="client_section layout_padding" id="testimonial">
    <div class="container">
      <div class="col-md-11 col-lg-10 mx-auto">
        <div class="heading_container heading_center">
          <h2>Testimoni Pelanggan</h2>
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="detail-box">
                <h4>M. Abdul Rafi</h4>
                <p>
                  Pelayanan bagus, tempatnya bersih dan nyaman, mie ayam nya enak banget!
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
            <div class="carousel-item">
              <div class="detail-box">
                <h4>M. Fauzan Al-Ansor</h4>
                <p>
                  Tempatnya nyaman, bersih, pelayanannya bagus ramah-ramah, makanannya enak banget... harganya terjangkau!
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
            <div class="carousel-item">
              <div class="detail-box">
                <h4>Albanni Dzikri Aulia</h4>
                <p>
                  Tempatnya cozy, harganya gak terlalu mahal, pelajar friendly, pelayanannya ramah, dan tempatnya estetik!
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev d-none" href="#customCarousel1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  {{-- ─── END TESTIMONIAL ─── --}}


  <div class="footer_container">

    {{-- ─── INFO SECTION ─── --}}
    <section class="info_section">
      <div class="container">
        <div class="contact_box">
          <a href="https://maps.google.com/?q=SMK+MARHAS+Margahayu" target="_blank" title="SMK MARHAS Margahayu">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
          </a>
          <a href="tel:085136447545" title="085136447545">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </a>
          <a href="mailto:alvenoir@gmail.com" title="alvenoir@gmail.com">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
        <div class="info_links">
          <ul>
            <li class="active">
              <a href="#hero">Home</a>
            </li>
            <li>
              <a href="#menu">Menu</a>
            </li>
            <li>
              <a href="#cara-pesan">Cara Pesan</a>
            </li>
            <li>
              <a href="#about">Tentang Kami</a>
            </li>
            <li>
              <a href="#testimonial">Testimonial</a>
            </li>
          </ul>
        </div>
        <div class="social_box">
          <a href="https://instagram.com/alvenoir_kitchen" target="_blank" title="@alvenoir_kitchen">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
          <a href="https://facebook.com/alvenoir_kitchen" target="_blank" title="Avenoir Kitchen">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="mailto:alvenoir@gmail.com" title="alvenoir@gmail.com">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
    {{-- ─── END INFO SECTION ─── --}}

    {{-- ─── FOOTER ─── --}}
    <footer class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> Avenoir Kitchen &mdash; SMK MARHAS Margahayu &mdash; Kelompok 7
        </p>
      </div>
    </footer>
    {{-- ─── END FOOTER ─── --}}

  </div>

  {{-- Scripts --}}
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  {{-- Slick slider - pakai URL persis dari template delfood (tanpa integrity agar tidak diblokir) --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
  {{-- Nice select --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    document.getElementById('displayYear').textContent = new Date().getFullYear();
  </script>

</body>

</html>