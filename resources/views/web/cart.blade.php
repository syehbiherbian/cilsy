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
    .content-section {
        margin-bottom: 30px;
    }
    .cart-list {
        margin: 20px 0;
        font-size: 20px;
    }
    .cart-price {
        font-weight: bold;
        text-align: right
    }
    .cart-total {
        font-size: 22px;
        font-weight: bolder;
        margin-bottom: 20px;
    }
    .cart-total .row {
        border-top: 2px solid #e8e8e8;
        border-bottom: 2px solid #e8e8e8;
        padding: 20px 0;
    }
</style>
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Total <span id="span-total">{{ count($carts) }}</span> tutorial dalam Keranjang Belanja</h3>  
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 well">
                @php
                $total = 0;
                @endphp
                @foreach ($carts as $cart)
                    <div class="row cart-list">
                        <div class="col-md-3">
                            <img src="{{ url($cart->lesson->image) }}" width="100%">
                        </div>
                        <div class="col-md-6 cart-title">
                            {{ $cart->lesson->title }}
                        </div>
                        <div class="col-md-2 cart-price">
                            Rp{{ number_format($cart->lesson->price, 0, ",", ".") }}
                        </div>
                        <div class="col-md-1">
                            <i class="fa fa-trash"></i>
                        </div>
                    </div>
                    @php $total += $cart->lesson->price; @endphp
                @endforeach
            </div>
        </div>
        <div class="row cart-total">
            <div class="col-md-offset-9 col-md-3">
                <div class="row">
                    <div class="col-md-6">
                        Total
                    </div>
                    <div class="col-md-6">
                        Rp{{ number_format($total, 0, ",", ".") }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-9 col-md-3">
                <form action="{{ url('member/checkout')}}" method="post">
                    {{ csrf_field() }} 
                    <button class="btn btn-primary btn-lg" style="background-color: #3CA3E0; border:0;">Pilih Metode Pembayaran</button>
                </form>
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