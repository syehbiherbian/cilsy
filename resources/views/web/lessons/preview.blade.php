@extends('web.app')
@section('title',$lessons->title.' | ')
@section('description', $lessons->meta_desc)
@section('content')
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('template/web/css/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
<link href="{{ asset('template/web/css/videojs-errors.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
{{-- <link href="https://vjs.zencdn.net/5.16.0/video-js.min.css" rel="stylesheet"/> --}}
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
<script src="https://rawgit.com/atlance01/vrapp-ionic/master/www/js/lib/videojs-playlist.js"></script>
<style>
  body {
    /*font-family: Arial, sans-serif;*/
  }

</style>

<div id="content-section">

  <div id="cat-images">
    <div class="container">


      <section class="video-player mb-50">
      <div class="container">
        <!-- Title -->
        <div class="row pt-25 pb-15"> 
          <div class="col-xs-12 col-md-10">
            <p class="lesson-title">{{ $lessons->title }}</p>
            <p><img src="{{asset('template/web/img/video.png')}}" alt="" style="height:25px; width:25px;"> <b>{{ count($main_videos) }}</b> Video</p>
          </div>
          <div class="col-xs-12 col-md-2">
          <ul style="right">
            @if($tutor == null)
            <div class="lesson-video-count">Rp{{ number_format($lessons->price, 0, ",", ".") }}</div>
            <button id="beli-{{ $lessons->id }}" type="button" class="lesson-video-count" onclick="addToCart({{ $lessons->id }})"><i class="fa fa-shopping-cart"></i> Beli</button>
            <a id="guest-{{ $lessons->id }}" href="{{ url('cart') }}" class="btn" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; display:none;">Lihat Keranjang</a>
            @endif  
          </ul>  
          </div>
        </div><!--./ Title -->

    </div>

</div>
<script src="{{ asset('template/web/js/video.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist-ui.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-errors.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/sweetalert2@7.9.2/dist/sweetalert2.all.js"></script>
<script src="{{ asset('template/web/js/component.js') }}"></script>
<script src="{{ asset('template/web/js/control-bar/control-bar.js') }}"></script>
<script>
    var cek = localStorage.getItem('cart');
    if(cek != null){
      var results = JSON.parse(cek);
      if (results.length > 0){
        $.each(results, function(k,v) {
              $('#beli-'+v['id']).hide();
              $('#guest-'+v['id']).show();
        });
      }
    }
  </script>
@endsection
