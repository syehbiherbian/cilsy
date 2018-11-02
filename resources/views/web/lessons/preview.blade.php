@extends('web.app')
@section('title',$lessons->title)
@section('description', $lessons->description)
@section('content')
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('template/web/css/landing.css') }}" rel="stylesheet">
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
{{--  <link href="{{ asset('template/web/css/bootstrap4.min.css') }}" rel="stylesheet">  --}}
<style>
  .fa-play-circle{
    color: #2BA8E2;
  }
  .close-icon {
    webkit-appearance: none;
    appearance: none;
    position: absolute;
    top: -15px;
    right: -15px;
    width: 35px;
    height: 35px;
    color: #fff;
    font-size: 14px;
    background: #222;
    border: none;
    outline: none;
    border-radius: 50%;
    cursor: pointer;
    vertical-align: middle;
  }
</style>
<main>

  <!-- Section Header -->
  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12">
          Kategori {{$categories->title}}
          <h1 class="price">Rp. {{ number_format($lessons->price, 0, ",", ".") }}</h1>
          <h1>{{$lessons->title}}</h1>
          <h6 class="mb-4">Oleh {{$contributors->username}}, Created at {{ $tanggal }}</h6>
          <a id="guest-{{ $lessons->id }}" href="{{ url('cart') }}" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>        
          <?php if(($cart != null)){ ?>
          <a href="{{ url('cart') }}" class="btn btn-lg btn-primary mb-2" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
          <?php }else{ ?>          
          <button id="beli-{{ $lessons->id }}" class="btn btn-lg btn-primary mb-2" onclick="addToCart({{ $lessons->id }})"><i class="fa fa-shopping-cart"></i> Beli Tutorial</button> &nbsp;&nbsp;&nbsp;
          <?php } ?>
          <button class="btn btn-lg btn-secondary mb-2" data-toggle="modal" data-target="#ModalVideo">Preview Tutorial</button>
        </div>
        <div class="col-md-4 col-xs-12 video-preview">
          <img src="{{ asset($lessons->image) }}" class="img-responsive" alt="" height="195" width="290">
        </div>
        <div class="col-xs-12 mt-4">
          <i class="fa fa-film"></i> {{ count($main_videos) }} Video Tutorial Eklusif &nbsp;
          <i class="fa fa-book"></i> Modul dan Script Praktek &nbsp;
          <i class="fa fa-jsfiddle"></i> Akses Selamanya &nbsp;
          <i class="fa fa-commenting-o"></i> Support Selamanya
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5">
    <div class="container">

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          <h5>Deskripsi Tutorial</h5>
          {!! nl2br($lessons->description) !!}

          <h5>Objektif Tutorial</h5>
          {!! nl2br($lessons->goal_tutorial) !!}
        </div>
      </div>

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          <h5 class="mb-4">Kurikulum Tutorial</h5>
          <?php $count = 0; ?>
          @foreach ($main_videos as $row)
          <?php if($count == 3) break; ?>
          <h6><a href="#" data-href="{{ asset($row->video)}}" class="showModal" data-toggle="tooltip" title="Preview Tutorial"><i class="fa fa-play-circle"></i> {{$row->title}}</a></h6>
          <span class="pull-right" style="color:#2BA8E2;">
          <?php
          // Set our duration in seconds
          echo gmdate("i:s", $row->durasi);
          ?>
          </span>
          {!! nl2br($row->description) !!}
          <hr>
          <?php $count++; ?>
            @endforeach

          <div class="collapse" id="collapseKurikulum">
              <?php $count = 0; ?>
              @foreach ($main_videos as $row)
              @if($count>2)
              <h6><i class="fa fa-lock"></i> {{$row->title}}</h6>
              <span class="pull-right">
                <?php
                // Set our duration in seconds
                echo gmdate("i:s", $row->durasi);
                ?>
                </span>
              {!! nl2br($row->description) !!}
              <hr>
              @endif
              <?php $count++; ?>
              @endforeach

          </div>

          <a id="collapse" data-toggle="collapse" href="#collapseKurikulum" role="button">+ Tampilkan Lebih Banyak</a>
        </div>
      </div>


      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12">
          <h5>Prerequistes dan Requirements</h5>
          {!! nl2br($lessons->requirement) !!}

          <h5>Audiens yang dituju</h5>
          {{ $lessons->audiens }}

          <h5>Frequently Asked Questions</h5>
          Lihat halaman <a href="/faq"> Frequently Asked Questions</a> untuk menemukan informasi tambahan atau hubungi langsung tim support kami
        </div>
      </div>

      <!-- Row -->
      <div class="row box">
        <div class="col-xs-12 mb-3">
          <b>Tentang Kontributor</b>
        </div>
        <div class="col-lg-3 col-md-4 mb-4 text-center">
            @if ($contributors->avatar)
            <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center mb-2">
          @else
            <img src="{{ asset('template/web/img/user.png') }}" alt="" class="img-responsive img-center mb-2">
          @endif
          <div class="row py-2 m-0 user">
            <div class="col-xs-12 ">
                {{ count($contributors_total_lessons) }} Tutorial
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8">
          <h5>{{ $contributors->username }}</h5>
          <h6>{{ $contributors->pekerjaan }}</h6>
          <a href="{{ url('contributor/profile/'.$contributors->username) }}" class="btn btn-primary btn-round my-2">Lihat Profile</a>
          <p>
              {{ $contributors->deskripsi }}
          </p>
          <a href="#">Lebih Banyak</a>
        </div>
      </div>

      <hr>

      <!-- Row -->
      <div class="row">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 text-center mt-5">
          <h3 class="mb-4">{{$lessons->title}}</h3>
          <a id="tamu-{{ $lessons->id }}" href="{{ url('cart') }}" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none" >Lihat Keranjang</a>        
          <?php if(($cart != null)){ ?>
          <a href="{{ url('cart') }}" class="btn btn-lg btn-primary mb-2" style="background-color:#fff; color:#5bc0de; border-color:#46b8da;" >Lihat Keranjang</a> &nbsp;&nbsp;&nbsp;       
          <?php }else{ ?>          
          <button id="jual-{{ $lessons->id }}" class="btn btn-lg btn-primary mb-2" onclick="addToCart({{ $lessons->id }})"><i class="fa fa-shopping-cart"></i> Beli Tutorial</button> &nbsp;&nbsp;&nbsp;
          <?php } ?>
          <button class="btn btn-lg btn-secondary mb-2" data-toggle="modal" data-target="#ModalVideo">Preview Tutorial</button>
        </div>
      </div>
    </div>
  </section>

</main>


<!-- Modal -->
<div class="modal fade" id="ModalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <a class="btn close-icon" data-dismiss="modal" ><i class="fa fa-times" aria-hidden="true"></i></a>
        <div class="modal-body p-0">
          <video width="100%" height="350" controls name="preview" controlsList="nodownload" ><source src="{{ asset($preview->video)}}"></video>
        </div>
        <div class="modal-body">
            <?php $count = 0; ?>
            @foreach ($main_videos as $row)
            <?php if($count == 3) break; ?>
            <h6><i class="fa fa-play-circle"></i> <a href="#" data-href="{{ asset($row->video)}}" class="showModal"> {{$row->title}} </a></h6>
            {!! nl2br($row->description) !!}
            <hr>
            <?php $count++; ?>
              @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  fbq('track', 'ViewContent');
</script>
<script>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
              $('#beli-'+v['id']).hide();
              $('#guest-'+v['id']).show();
              $('#jual-'+v['id']).hide();
              $('#tamu-'+v['id']).show();
        });
      }
    }
    @if($cart != null)
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
          $('#guest-'+v['id']).hide();
          $('#tamu-'+v['id']).hide();
        });
      }
    }
    
    @endif

  </script>
  <script>
    $('#collapse').click(function(){ 
        $(this).text(function(i,old){
            return old=='+ Tampilkan Lebih Banyak' ?  '- Tampilkan Lebih Sedikit' : '+ Tampilkan Lebih Banyak';
        });
    });
    $(function(){
      $('#ModalVideo').modal({
          show: false
      }).on('hidden.bs.modal', function(){
          $(this).find('video')[0].pause();
      });
    });
    $(document).ready(function(){
      $(".showModal").click(function(e){
        e.preventDefault();
        var url = $(this).attr("data-href");
        $("#ModalVideo video").attr("src", url);
        $("#ModalVideo").modal("show");
      });
     });
    </script>
@endsection
