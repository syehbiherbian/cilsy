@extends('web.app')
@section('title','Order Summary | ')
@section('content')
<style>
    // Break Point 
$tablet-width		: 767px;
$mobile-width		: 640px;

// Tablet 
@mixin tablet {
	@media screen and (max-width: #{$tablet-width}) {
		@content;
	}
}

// Mobile
@mixin mobile {
	@media screen and (max-width: #{$mobile-width}) {
		@content;
	}
}
    .box-summary{
        width: 1000px;
        padding: 5%;
        margin: 185px auto;
        maegin-top :100px;
        background: white;
        box-shadow: 0 20px 30px -20px rgba(2, 2, 2, 0.8), 0 20px 30px 0px rgba(30, 30, 30, 0.3);
        height: 500px;
    }
    .bawah{
        margin-bottom: 10px;
    }
    /* CSS used here will be applied after bootstrap.css */
    .shadow {
    -moz-box-shadow:    0px 3px 20px 2px rgba(0,0,0,.4);
    -webkit-box-shadow: 0px 3px 20px 2px rgba(0,0,0,.4);
    box-shadow:         0px 3px 20px 2px rgba(0,0,0,.4);
    margin-top: 150px;
    margin-bottom: 150px;
    }
    .kiri{
    min-height: 500px;
    border-right: 2px;
    background-color: #fff;
    padding:60px;
    }
    .kanan {
    min-height: 500px;
    background-color: #fff;
    padding:60px;
    }
    .btn-link{
    border:none;
    outline:none;
    background:none;
    cursor:pointer;
    color:#0000EE;
    padding:0;
    text-decoration:none;
    font-family:inherit;
    font-size:inherit;
    }
    .btn-link:active{
    color:#FF0000;
    }
    .btn-ganti{
        float: right;
        margin-top: 30px;
        margin-bottom: 10px;
        text-decoration: none;
        font-color: #3CA3E0;
        cursor: pointer;
        font-family:inherit;
        border:none;
        background:none;
        padding: 0px;
    }
    @media(max-width:768px;){
    }
    .paket {
        line-height: 1.5em;
        list-style-image: url('../template/web/img/check.png');
    }
    .icon-ganti{
        background-image: url('../template/web/img/ganti.png');
        height: 15px;
        width: 15px;        
    }
</style>
<div class="content-section">
    <div class="container">
  	<div class="shadow">
      <div class="row shadow">
          <div class="col-sm-12 col-xs-12 kanan col-md-6 hidden-xs hidden-sm">
            <div class="col-md-12">
                <h2>Keranjang Belanja</h2>     
            </div>
            <div class="col-md-12">   
                <div class="row">
                    <div class="col-md-9">Tutorial</div>
                    <div class="col-md-3">Harga (Rp)</div>
                </div>
                @php
                $total = 0;
                @endphp
                @foreach ($carts as $cart)
                    <div class="row">
                        <div class="col-md-9">{{ $cart->lesson->title }} <br> pemateri <b>{{ $cart->contributor->first_name . ' ' . $cart->contributor->last_name }}</b></div>
                        <div class="col-md-3" style="text-align: right">{{ number_format($cart->lesson->price, 0, ",", ".") }}
                        @php $total += $cart->lesson->price; @endphp
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
          <div class="col-sm-12 col-xs-12 col-md-6 kiri">
            <div class="col-md-12 col-sm-6">
             <h3>Order Summary</h3>
            </div>   
            <hr>
            <div class="col-md-6 bawah">
            @if (session()->has('coupon'))
            Discount ({{ session()->get('coupon')['name'] }})
            <form action="{{ url('coupon/delete') }}" method="POST" style="display:inline">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" style="font-size:14px" class="btn-link">Remove</button>
            </form>
            </div>
            <div class="col-md-6 bawah">
                @if(session()->get('coupon')['type'] == 'fixed')
                Rp. {{ session()->get('coupon')['value'] }}
                @elseif(session()->get('coupon')['type'] == 'percent')
                Diskon {{ session()->get('coupon')['percent_off'] }} %
                @endif
            @endif
            </div>
            @if(session()->has('coupon'))
            <div class="col-md-6 bawah">
            </div>
            @endif
            <div class="col-md-6 bawah">
            
            </div>
            <div class="col-md-6 bawah">
                Jumlah Pembayaran 
            </div>
            <div class="col-md-6 bawah">
                @if(session()->has('coupon'))
                <b>Rp. {{ session()->get('coupon')['discount'] }}</b>
                @else
                <b>Rp. {{ $total }}</b>
                @endif
            </div>
            <div class="col-md-12 bawah">
            @if (! session()->has('coupon'))
            <a href="#" class="have-code" id="hide" style="display:block">Gunakan Kode Promo</a>
            <form action="{{ url('coupon') }}" method="POST" id="form" style="display:none;">
                {{ csrf_field() }}
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo Code" name="coupon_code">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" style="background-color: #3CA3E0;">Gunakan</button>
                </span>
               
                </div><!-- /input-group -->
             </form>
                @if (session()->has('success_message'))
                            <div class="spacer"></div>
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif

                        @if(count($errors) > 0)
                            <div class="spacer"></div>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                @endif
            @endif
            </div>
            <hr>
            <div class="col-md-6 bawah">
                Email
            </div>
            <div class="col-md-6 bawah">
                {{ session()->get('email') }}
            </div>
            <div class="col-md-12">
                <form action="{{ url('member/checkout')}}" method="post">
                {{ csrf_field() }} 
                <button class="btn btn-primary" style="width:100%; background-color: #3CA3E0; border-radius:0px;">Lanjutkan Pembayaran</button>
                </form>
            </div>
          </div>
      </div>
  	</div>
</div>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        document.getElementById('form').style.display = 'block';
        document.getElementById('hide').style.display = 'none';
    });
});
</script>
</div>
@endsection