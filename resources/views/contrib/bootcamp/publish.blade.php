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

        <!-- Tab Publish -->
        <div class="tab-pane fade active in" id="pills-publish" role="tabpanel" aria-labelledby="pills-publish-tab">
        <!-- Title  -->
        <div class="box">
            <div class="row">
              <div class="col-xs-12 p-4">
                <h4 class="text-inline">Publish <i class="far fa-question-circle"></i></h4>
              </div>
            </div>
          </div>

          <div class="box my-4">
            <div class="row">
              <div class="col-xs-12">
                <h5 class="mb-4">Publish</h5>
                <h6 class="text-inline">Bootcamp belum dipublish</h6>
                <button class="btn btn-green">Publish</button>
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
