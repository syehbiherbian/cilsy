@extends('web.app')
@section('title','')
@section('content')
<style>
  .card img {
    position: absolute;
    top: 24px;
    right: 110px;
    width: 150px;
}
</style>
<div id="top-section">

</div>

    <div id="content-section">
        <div class="container">
          <h2 align="center" style="font-weight:bold;">INFO POINT</h2><br>
          <p align="center" style="font-size: 19px; font-weight: bold;">
            Point didapatkan dari keaktifan anda berkontribusi di tutorial berupa berkomentar, menjawab pertanyaan dan menyelesaikan tutorial.
          </p>
          <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" style="text-align: center;" />
                    </div>
                    <h5 align="center" style="font-weight: bold">3 Point</h5>
                    <p align="center" style="font-weight: bold">Menjawab Komentar</p>
                </div>
                <div class="col-md-4">
                    <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/3.png')}}" alt="" />
                    </div>
                    <h5 align="center" style="font-weight: bold">3 Point</h5>
                    <p align="center" style="font-weight: bold">Menjawab Komentar</p>
                </div>
          </div>
          <div class="col-md-12">
            <h2 align="center" style="font-weight:bold;">BADGE</h2>
            <p align="center" style="font-size: 19px; font-weight: bold;">
            Badge akan berubah ketika mencapai syarat point minimal pada masing masing badge
            </p>
            <div class="row">
              <div class="col-md-3">
                <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" style="text-align: center;" />
                    </div>
                    <h5 align="center" style="font-weight: bold">Contributor = 20</h5>
              </div>
              <div class="col-md-3">
                <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" style="text-align: center;" />
                    </div>
                    <h5 align="center" style="font-weight: bold">Tutor = 60</h5>
              </div>
              <div class="col-md-3">
                <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" style="text-align: center;" />
                    </div>
                    <h5 align="center" style="font-weight: bold">Expert = 80</h5>
              </div>
              <div class="col-md-3">
                <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" style="text-align: center;" />
                    </div>
                    <h5 align="center" style="font-weight: bold">Master = 100</h5>
              </div>
            </div>
          </div>
            </div>
        </div>
    </div>
@endsection()
