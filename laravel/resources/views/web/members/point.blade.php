@extends('web.app')
@push('css')
<style media="screen">
  .btn-more{
    background-color: #2ba8e2;
    color: #fff;
  }
  .member-point .point-information .cover .member{
    color: #fff;
  }
  .member-point .point-information .cover .counter .item {
    color: #fff;
    width: 130px;
    height: 130px;
    border-radius: 50%;
  }
  .member-point .point-information .cover .counter .item .middle{
    display: table;
  }
  .member-point .point-information .cover .counter .item .inner{
    display: table-cell;
    vertical-align: middle;
  }
  .green{
    background-color: #1cc327;
  }
  .blue{
    background-color: #2798cc;
  }
  .purple{
    background-color: #a238b9;
  }

</style>
@endpush
@section('content')
<section class="member-point pt-25 pb-25">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="point-information">
          <div class="cover p-25 pb-0 mb-25" style="background:url('{{ asset('template/web/img/point/point-cover.png') }}') no-repeat;">
            <div class="row member">
              <div class="col-md-12">
                <div class="avatar text-center">
                  <img src="{{ asset('assets/source/avatar/1.png') }}" alt="" class="img-circle">
                </div>
                <div class="text-center">
                  <h3 class="name">Muhammad</h3>
                  <p class="total-point">210 pts</p>
                </div>
              </div>
            </div>
            <div class="row counter">
              <div class="col-xs-4">
                <div class="item middle text-center green">
                  <div class="inner">
                    <img src="" alt="">
                    <p>Bertanya</p>
                    <p>210 pts</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="item middle text-center blue">
                  <div class="inner">
                    <img src="" alt="">
                    <p>Menjawab Pertanyaan</p>
                    <p>210 pts</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="item middle text-center purple">
                  <div class="inner">
                    <img src="" alt="">
                    <p>Menyeselesaikan Tutorial</p>
                    <p>210 pts</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="more text-center">
            <a href="{{ url('point') }}" class="btn btn-default btn-lg btn-more mb-25" target="_blank">Pelajari lebih lanjut tentang Point</a>
            <p class="term-conditions">Point akan berubah atau bertambah dalam waktu 24 jam</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <strong>Rewards</strong>
        <div class="owl-carousel owl-theme rewards-carousel">
          <div class="item">
            <img src="{{ asset('assets/source/rewards/1.png') }}" alt="">
            <div class="caption">
              <p>Zalora</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')
<script type="text/javascript">
  $(document).on('ready',function () {
    rewardCarousel();
  });
  function rewardCarousel() {
    $('.rewards-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      items:1
    });
  }
</script>
@endpush
