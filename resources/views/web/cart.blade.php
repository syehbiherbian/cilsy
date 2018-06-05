@extends('web.app')
@section('title','Order Summary | ')
@section('content')
<style>
    /* CSS used here will be applied after bootstrap.css */
    .shadow {
    -moz-box-shadow:    3px 3px 10px grey;
    -webkit-box-shadow: 3px 3px 10px grey;
    box-shadow:         3px 3px 10px grey;
    /* margin-top: 150px; */
    /* margin-bottom: 150px; */
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
    #cart-total {
        font-size: 26px;
        font-weight: bolder;
        margin-bottom: 20px;
    }
    #cart-total .row {
        border-top: 2px solid #e8e8e8;
        border-bottom: 2px solid #e8e8e8;
        padding: 20px 0;
    }
</style>
<div class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Keranjang Belanja (<span id="tutorial-total">{{ count($carts) }}</span> tutorial)</h3>  
            </div>
        </div>
        <div class="row">
            @php
            $total = 0;
            @endphp
            @if (count($carts) > 0)
                @foreach ($carts as $cart)
                <div class="col-sm-12 well shadow">
                    <div class="row cart-list">
                        <div class="col-md-2">
                            <center><img src="{{ url($cart->lesson->image) }}" style="max-width:100%;max-height:100px;"></center>
                        </div>
                        <div class="col-md-7 cart-title">
                            {{ $cart->lesson->title }}
                        </div>
                        <div class="col-md-2 cart-price">
                            Rp{{ number_format($cart->lesson->price, 0, ",", ".") }}
                        </div>
                        <div class="col-md-1">
                            <form action="{{ url('cart/delete/'.$cart->id)}}" method="post">
                                {{ csrf_field() }} 
                                {{ method_field('delete') }} 
                                <button class="btn btn-default btn-lg"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @php $total += $cart->lesson->price; @endphp
                @endforeach
            @else
            <div id="cart">
                <div class="col-sm-12 well">
                    <h4>
                        <center>
                            <img src="{{ url('/template/web/img/CART.png') }}" width="80px"><br>
                            <span style="margin: 10px 0;display:block;">Keranjang Anda kosong. Silakan pilih tutorial yang Anda inginkan!</span><br>
                            <a href="{{ url('/lessons/browse/all') }}" class="btn btn-primary btn-lg" style="background-color: #3CA3E0; border:0; padding-top:20px;padding-bottom:20px">Browse Tutorial</a>
                        </center>
                    </h4>
                </div>
            </div>
            @endif
        </div>
        <div id="cart-total" class="row  {{ !count($carts) ? 'hide' : '' }}">
            <div class="col-md-offset-8 col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        Total
                    </div>
                    <div class="col-md-6" style="text-align:right">
                        <span id="total-price">Rp{{ number_format($total, 0, ",", ".") }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="cart-pay" class="row  {{ !count($carts) ? 'hide' : '' }}">
            <div class="col-md-offset-8 col-md-4" style="padding:0">
                <form action="{{ url('member/checkout')}}" method="post">
                    {{ csrf_field() }} 
                    <button class="btn btn-primary btn-lg btn-block" id="inicheckout" style="background-color: #3CA3E0; border:0; padding-top:20px;padding-bottom:20px">Pilih Metode Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
fbq('track', 'AddToCart');
</script>

<script type="text/javascript">
  var button = document.getElementById('inicheckout');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'InitiateCheckout');
    },
    false
  );
</script>

@if (!Auth::guard('members')->user()) 
<script>
    $('document').ready(function(){
        var cart = localStorage.getItem('cart');
        if (cart != null) {
            var carts = JSON.parse(cart);
            if (carts.length > 0){
                var html = '';
                var total = 0;
                $.each(carts, function(k,v) {
                    html += '<div id="cart-'+v.id+'" class="col-sm-12 well shadow">';
                    html += '<div class="row cart-list">';
                    html += '<div class="col-md-2">'
                    html += '<center><img src="'+v.image+'" style="max-width:100%;max-height:100px;"></center>';
                    html += '</div>';
                    html += '<div class="col-md-7 cart-title">';
                    html += v.title;
                    html += '</div>'
                    html += '<div class="col-md-2 cart-price">';
                    html += 'Rp'+v.price.toLocaleString('id', 'idr');
                    html += '</div>';
                    html += '<div class="col-md-1">';
                    html += '<button type="button" onclick="deleteCart('+v.id+')" class="btn btn-default btn-lg"><i class="fa fa-trash"></i></button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    total += parseInt(v.price);
                });

                $('#tutorial-total').html(carts.length);
                $('#cart').html(html);
                $('#cart-total, #cart-pay').removeClass('hide');
                $('#total-price').html('Rp'+total.toLocaleString('id', 'idr'));
            }
        }
    });
</script>

@endif
@endsection
