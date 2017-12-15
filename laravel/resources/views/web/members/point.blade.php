@extends('web.app')
@section('title','Dashboard | ')
@section('content')


<section class="member-point mb-25">
  <div class="container-fluid p-0 mb-25">
    <div class="row m-0">
      <div class="col-md-12 p-0">
            <img src="{{ asset('template/web/img/banner_point.png') }}" alt="" class="img-responsive">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row mb-25">
      <div class="col-md-12 text-center">
        <h2>Info Point</h2>
        <p>Point di dapatkan dari ke aktifan anda berkontribusi di tutorial berupa komentar, </br> menjawab pertanyaan dan menyelesaikan tutorial.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="text-center">
          <img src="{{ asset('template/web/img/point/point_comments.png') }}" alt="" class="img-responsive img-center">
          <div class="caption mt-15">
            <strong>2 Point</strong>
            <p>Berkomentar</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
          <img src="{{ asset('template/web/img/point/point_reply_comments.png') }}" alt="" class="img-responsive img-center">
          <div class="caption mt-15">
            <strong>2 Point</strong>
            <p>Menjawab Komentar</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
          <img src="{{ asset('template/web/img/point/point_tutorial.png') }}" alt="" class="img-responsive img-center">
          <div class="caption mt-15">
            <strong>2 Point</strong>
            <p>Menyelesaikan Tutorial</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
