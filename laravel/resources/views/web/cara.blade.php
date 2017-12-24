@extends('web.app')
@section('title','Cara Pesan | ')
<link href="{{asset('template/web/css/page.css')}}" rel="stylesheet">

@section('content')
<section class="intro">
  <div class="container">
    <h1>CARA PESAN</h1>
    <h4>Ikuti 5 langkah mudah dibawah ini untuk pesan paket langganan di Cilsy</h4>
  </div>
</section>

<section class="timeline">
  <ul>
    <li>
      <div>
        <time>DAFTAR</time> Klik daftar untuk membuat akun baru
      </div>
    </li>
    <li>
      <div>
        <time>Pilih Paket Langganan</time> Pilih paket sesuai budget dan kebutuhan anda
      </div>
    </li>
    <li>
      <div>
        <time>Pilih Metode Pembayaran</time> Tentukan metode pembyaran yang anda inginkan, bisa melalui kartu kredit atau bank transfer
      </div>
    </li>
    <li>
      <div>
        <time>Bayar</time> Lakukan pembayaran sesuai petunjuk dan metode yang anda pilih, tanpa melakukan konfirmasi pembayaran
      </div>
    </li>
    <li>
      <div>
        <time>Akses Video Tutorial</time> Berhasil,  Silahkan Login kembali dan akses semua materi tutorial
      </div>
    </li>
  </ul>
</section>
<section class="intro">
  <div class="container">
    <h1>Akses ke semua tutorial sekarang!</h1>
    <button type="button" class="btn btn-lg"><a href="{{ url('pages/harga') }}" style="text-decoration: none; padding: 20px;">Lihat Harga Paket</a></button>
    <button type="button" class="btn btn-lg btn-yellow" ><a href="#" style="text-decoration: none; padding: 20px;">Buat akun sekarang</a></button>
  </div>
</section>	
<script>
(function() {

  'use strict';

  // define variables
  var items = document.querySelectorAll(".timeline li");

  // check if an element is in viewport
  // http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
  function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  function callbackFunc() {
    for (var i = 0; i < items.length; i++) {
      if (isElementInViewport(items[i])) {
        items[i].classList.add("in-view");
      }
    }
  }

  // listen for events
  window.addEventListener("load", callbackFunc);
  window.addEventListener("resize", callbackFunc);
  window.addEventListener("scroll", callbackFunc);

})();
</script>
@endsection