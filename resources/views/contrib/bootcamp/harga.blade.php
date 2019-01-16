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

        <!-- Tab Harga -->
            <div class="tab-pane fade active in" id="pills-harga" role="tabpanel" aria-labelledby="pills-harga-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Harga <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right">Lihat Skema Harga dan Pembagian</button>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-5">Harga</h5>
                    <h6>Harga Bootcamp</h6>
                    <div class="form-group">
                      <div class="col-sm-2 col-xs-5">  
                        <select class="form-control" name="matauang" id="matauang">
                          <option value="idr">IDR</option>
                          <option value="dollar">$</option>
                        </select>
                      </div>
                      <div class="col-sm-4 col-xs-7">
                        <input class="form-control" type="text" name="harga" id="harga" placeholder="Minimal 50.000">
                      </div>
                    </div>

                    <button class="btn btn-green pull-right mt-4">Upload File</button>
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
