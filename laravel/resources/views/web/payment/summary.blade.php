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
    min-height: 300px;
    border-right: 2px;
    background-color: #fff;
    }
    .kanan {
    min-height: 300px;
    background-color: #fff;
    }
</style>
<div class="content-section">
    <div class="container">
  	<div class="shadow">
      <div class="row shadow">
          <div class="col-sm-12 col-xs-12 col-md-6 kanan"><p>gini bih</p></div>
          <div class="col-sm-12 col-xs-12 col-md-6 kiri">
              <div class="col-md-12">
             <h3>Order Summary</h3>
            </div>   
            <div class="col-md-6 bawah">
                Harga 
            </div>
            <div class="col-md-6 bawah">
                Rp. {{ session()->get('package')['harga'] }}
            </div>
            <div class="col-md-6 bawah">
                Plan 
            </div>
            <div class="col-md-6 bawah">
                Paket {{ session()->get('package')['paket'] }}
            </div>
            <hr>
            <div class="col-md-6 bawah">
            @if (session()->has('coupon'))
            Discount ({{ session()->get('coupon')['name'] }}) :
            {{--  <form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" style="font-size:14px">Remove</button>
            </form>  --}}
            </div>
            <div class="col-md-6 bawah">
                Rp. {{ session()->get('coupon')['value'] }}
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
                Rp. {{ session()->get('coupon')['discount'] }}
                @elseif(!session()->has('coupon'))
                Rp. {{ session()->get('price')}}
                @endif
            </div>
            <div class="col-md-12 bawah">
            @if (! session()->has('coupon'))
            <a href="#" class="have-code">Have a Code?</a>
            <form action="{{ url('coupon') }}" method="POST">
                {{ csrf_field() }}
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo Code" name="coupon_code">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Gunakan</button>
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
            <div class="col-md-6 bawah">
                Email
            </div>
            <div class="col-md-6 bawah">
                {{ session()->get('email') }}
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" style="width:100%; background-color: #3CA3E0; border-radius:0px;">Selanjutnya</button>
            </div>
          </div>
      </div>
  	</div>
</div>
</div>
@endsection
