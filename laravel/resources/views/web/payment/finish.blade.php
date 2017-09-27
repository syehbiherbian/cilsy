@extends('web.app')
@section('title','Pembayaran telah selesai | ')
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
        <h3>Terima kasih</h3>
        <p class="pay-desc">Paket langganan anda akan segera aktif jika transaksi pembayaran anda telah berhasil kami validasi .</p>
        <a href="{{ url('/') }}" class="btn btn-info">Telusuri Tutorial Sekarang</a>
      </div>
    </div>
  </div>

</div>
<script>
fbq('track', 'Purchase', {
value: 247.35,
currency: 'USD'
});
</script>
@endsection
