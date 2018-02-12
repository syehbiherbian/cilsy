@extends('web.app')
@section('title','Petunjuk Pembayaran | ')
@section('content')
<style>
.centered-pills { text-align:center; }
.centered-pills ul.nav-pills { display:inline-block; }
.centered-pills li { display:inline; }
.centered-pills a { float:left; }
@media(max-width: 768px) {
	.centered-pills { text-align:center; }
}
</style>
@push('css')
@endpush

<section class="intro">
  <div class="container">
    <h1 style="text-align: center;">Petunjuk Cara Pembayaran</h1>
    <h4 style="text-align: center;">Biarkan kami membantu anda menyelesaikan pembayaran</h4>
  </div>
</section>
<div class="container">
	<section class="faq mb-50 pl-15">
<div class="row" style="margin-top:20px;">
  <div class="span12 centered-pills">
    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#cc" style="padding: 17px 91px;">KARTU KREDIT</a></li>
      <li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding: 17px 91px;">TRANSFER BANK
	    <span class="caret"></span></a>
	    <ul class="dropdown-menu">
	      <li><a data-toggle="pill" href="#mandiri" style="padding: 17px 91px;">BANK MANDIRI</a></li>
	      <li><a data-toggle="pill" href="#permata" style="padding: 17px 91px;">BANK PERMATA</a></li>
	      <li><a data-toggle="pill" href="#bersama" style="padding: 17px 91px;">BANK LAINNYA (BCA,BNI,BRI,dll)</a></li> 
	    </ul>
	  	</li>
    </ul>
  </div>
</div>
<div class="tab-content">
	<div id="mandiri" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Mandiri
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Mandiri</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Klik Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor rekening dan Kode Perusahaan untuk melanjutkan pembayaran melalui ATM/Internet Banking Mandiri, Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>
		</ol>
		</div>
	</div>
	<div id="cc" class="tab-pane fade in active">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Kartu Kredit
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran Kartu Kredit</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-1.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Isikan data kartu kredit Anda lalu klik 'BAYAR SEKARANG'</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-2.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pembayaran berhasil. Klik tombol Selesai.</b>
				<img class="img-responsive" src="{{ asset('template/web/img/image-cc-3.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>
		</ol>	
	</div>
	</div>
	<div id="bersama" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Lainnya (Jika anda menggunakan bank BCA, BRI, BNI, dll).
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Bank Lainnya</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-3-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor Rekening untuk melanjutkan pembayaran melalui bank anda masing-masing. Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/step-4-lainnya.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>
		</ol>
		</div>
	</div>
	<div id="permata" class="tab-pane fade">
	<div class="col-md-6">
	Langkah Langkah Membayar menggunakan Bank Permata
	</div>
	<div class="col-md-6">
		<ol>
			<li>
				<b>Pilih Pembayaran ATM/Bank Transfer</b> <br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-1-mandiri.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Pilih Permata</b><br>
				<img class="img-responsive" src="{{ asset('template/web/img/step-2-permata.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Klik Lihat Nomor Rekening</b>
				<img class="img-responsive" src="{{ asset('template/web/img/permata-3.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Catat Nomor rekening untuk melanjutkan pembayaran melalui Bank Permata, Ikuti Petunjuk pada tab Bagaimana Cara Bayar untuk melakukan pembayaran. Klik Selesai</b>
				<img class="img-responsive" src="{{ asset('template/web/img/permata-4.png') }}" alt="step 1" style="margin-top: 20px; margin-bottom: 20px;">
			</li>
			<li>
				<b>Invoice dan cara pembayaran akan di kirimkan melalui email. Segera lakukan pembayaran sebelum tanggal yang tercantum. Anda tidak diharuskan untuk melakukan konfirmasi pembayaran. Jika pembayaran sudah dilakukan, akan ada pemberitahuan melalui email. Setelahnya silahkan anda login kembali dan akun anda sudah aktif secara otomatis. </b>
			</li>
		</ol>
		</div>
	</div>
</div>

</section>
</div>


@push('js')



@endpush
@endsection
