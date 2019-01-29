@extends('web.app')
@section('title','')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Cilsy</title>
  </head>
  <body>

    <!-- Section Header -->
    <section class="header">
        <i class="fa fa-circle"></i>
        <a href="{{ url('Bootcamp/Course') }}">Dashboard</a>
    </section>

    <!-- Section Content -->
    <section class="project-view mt-5">
      <div class="container">

        <div class="row">
          <div class="col-xs-12 text-center">
            <h4 class="c-blue">Linux Fundamental </h4>
            <h4 class="c-blue"> Final Projek</h4>
            <h5 class="text-muted">Become System Administrator Profesional</h5>
          </div>
        </div>

        <!-- Row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <h5>Project Preview</h5>
              </div>
              <div class="card-body">
                <ul class="project-preview">
                  <li>
                    1. OS dan Instalasi: Ubuntu 16.04
                    <ul>
                      <li>Link Download dimana dan langkah-langkah untuk membuat USB booting</li>
                      <li>Partisi/100gb/home1TB,swap 2GB</li>
                      <li>Dual boot dengan windows 7</li>
                    </ul>
                  </li>
                  <li>
                    2. Topologi dan jaringan
                    <ul>
                      <li>Desain topologi dan alokasi ip nya serta bagaimana agar koneksi ke internet</li>
                      <li>Bagaimana langkah mengkoneksikannya ke jaringan kabel agar seluruhnya terhubung</li>
                    </ul>
                  </li>
                  <li>
                    3. Apps
                    <ul>
                      <li>
                        Instalasi pengganti Photoshop, Microsoft office dan Corel Draw semuanya melalui CLI
                      </li>
                    </ul>
                  </li>
                  <li>
                    4. CLI
                    <ul>
                      <li>Buatkan 1 folder berisi text welcome.txt di folder /home yang berisi : Selamat datang di Ubuntu kami!. Semuanya harus pake CLI</li>
                    </ul>
                  </li>
                </ul>

                <div class="komentar mx-4">
                  Komentar
                  <div class="textarea">
                      Tidak Ada Komentar
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- Footer -->
    <section id="footer">
      <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="footer-logo" src="{{asset('img/logo-only.png')}}" alt="">
                <span class="footer-logo-text">Cilsy</span>
                <p>
                    Satu-satunya kursus online jaringan dan server yang dipandu sampai bisa. Terdapat ratusan video tutorial eksklusif serta trainer profesional yang siap membantu proses belajar anda.
                </p>
                <p class="copyrigth-text">
                    Copyright Cilsy Fiolution 2016-2018
                </p>
            </div>
            <div class="col-md-2">
                <ul class="nav-footer">
                    <li>Cilsy</li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="nav-footer">
                    <li>Ikuti Kami</li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Line</a></li>
                    <li><a href="#">Google+</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="nav-footer">
                    <li>Bantuan</li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Kebijakan Layanan</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <p class="copyrigth-text">
                    Sarijadi Blok 23, No. 80, Kota Bandung
                </p>
            </div>
        </div>
      </div>
    </section>


    <!-- JavaScript -->
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>
</html>