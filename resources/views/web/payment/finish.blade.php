@extends('web.app')
@section('title','Pemesanan Paket Berhasil | ')
@section('content')
<style media="screen">
@media (max-width:768px) {
    .section-content{
      min-height: 300px;
      padding-top: 50px;
    }
}
@media (min-width:768px) {
    .section-content{
      min-height: 460px;
      padding-top: 50px;
    }
}

  .section-content h3{
    font-weight: 700;
    color: #777;
    letter-spacing: 2px;
  }
  .section-content .pay-desc{
    color: #777;
    letter-spacing: 1px;
    line-height: 1.5;
    margin: 25px 0px;
  }
</style>
<div class="section-content">

  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 text-center ">
        <h3>Pemesanan Paket Langganan Cilsy Telah Berhasil </h3>
        <p class="pay-desc" align="justify">Selanjutnya silahkan lakukan pembayaran dengan mengikuti petunjuk pembayaran dari invoice yang sudah anda dapatkan melalui email.
<br><br>Setelah membayar, paket langganan Anda akan langsung aktif <b>tanpa perlu konfirmasi</b>. 
<br><br>Anda tinggal langsung login saja dan semua tutorial sudah akan langsung terbuka aksesnya.
<br><br>Jika mengalami kesulitan pembayaran, bisa langsung kontak ke whatsapp 089630713487 atau email ke support@cilsy.id.
<br><br><b>nb : Khusus bagi yang membayar via kartu kredit dan sukses, maka paket langganan anda sudah aktif dan tinggal langsung login saja.</b></p>
        <a href="{{ url('/lessons/browse/all') }}" class="btn btn-info">Mulai Belajar</a>
	<br>
	<br>
      </div>
    </div>
  </div>

</div>

<!--<script>
fbq('track', 'Purchase', {
value: 85000,
currency: 'IDR'
});
</script>-->
<script>
fbq('track', 'Purchase');

/* hapus cart*/
localStorage.removeItem('cart')
</script>
@endsection
