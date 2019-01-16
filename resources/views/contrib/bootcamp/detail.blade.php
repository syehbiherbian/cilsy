@extends('contrib.app')
@section('title','')
@section('breadcumbs')
@section('content')
<link href="{{asset('template/kontributor/css/dropify.min.css')}}" rel="stylesheet">


<!-- Main -->
    <main>

      <!-- Container -->
      <div class="container tabs-course">

        <div class="box header mt-5">
          <div class="row">
            <div class="col-sm-4 col-xs-12">
              <img :src="getCover()" class="img-rounded img-responsive" alt="">
            </div>
            <div class="col-sm-8 col-xs-12">
              <h4>Bootcamp <small class="c-yellow">Draft</small></h4>
              <h2>{{$bootcamp->title}}</h2>
            </div>
          </div>
        </div>

        <!-- Nav Tabs -->
        @include('contrib.bootcamp.nav')

        <!-- Tab Detail -->
            <div class="tab-pane fade active in" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Details <i class="far fa-question-circle"></i></h4>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Bootcamp Details</h5>
                    <div class="form-group">
                      Judul
                      <input class="form-control" type="text" name="" id="" value="Modul Ebook Mikrotik Lengkap dan komprehensif - For Beginner.pdf 300.2kb" >
                    </div>
                    <div class="form-group">
                      Sub Judul
                      <input class="form-control" type="text" name="" id="" value="Modul yang isinya sama dengan video, dan dapat digunakan sebagai bahan baca-baca atau kopi paster script." >
                    </div>
                    <div class="form-group">
                      <div class="col-xs-6 pl-0">
                        Kategori
                        <input class="form-control" type="text">
                      </div>
                      <div class="col-xs-6 pl-0">
                        Sub Kategori
                        <input class="form-control" type="text">
                      </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                      Cover Bootcamp
                      <input class="form-control dropify" type="file" name="" id="">
                    </div>
                    <div class="form-group">
                      Promotional Video
                      <input class="form-control dropify" type="file" name="" id="">
                    </div>
                    <div class="form-group">
                      Deskripsi Bootcamp
                      <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button class="btn btn-green pull-right">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Target Student</h5>
                    <div class="form-group">
                      Target Audience
                      <input class="form-control" type="text" name="" id="" value="Siapa yang harus mengikuti bootcamp anda" >
                    </div>
                    <div class="form-group">
                      Preusite and Requirement
                      <input class="form-control" type="text" name="" id="" value="Contoh: Harus memiliki Laptop dan Mikrotik" >
                    </div>
                    <button class="btn btn-green pull-right">+ Simpan</button>
                  </div>
                </div>
              </div>

              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5>Profile Instruktur</h5>
                    <div class="alert alert-info mt-4">
                      <i class="fa fa-check-circle c-orange"></i>
                      Semua Profile Anda telah lengkap
                    </div>
                    <img :src="getAvatar()" class="img-profile-instruktur" alt=""> Andriyana
                  </div>
                </div>
              </div>
            </div>
        </div>


    </div>

  </main>
  <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/dropify.min.js')}}"></script>
@endsection()
