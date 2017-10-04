@extends('web.app')
@section('title','Pilih Paket | ')
@section('content')
 <style>


.columns {
    float: left;
    width: 40%;
    padding: 8px;
}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    width: 77%;
    border-top: 5px solid rgba(238, 238, 238, 1);
}
.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    min-height: 660px;
}

.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #fff;
    color: black;
    font-size: 25px;
}

.price li {
    padding: 20px;
    text-align: center;
}

.price .grey {
    background-color: #fff;
    font-size: 20px;
    color: #2BA8E2;
}

.button {
    background-color: #2BA8E2;
    border: none;
    border-radius: 5px;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    margin-bottom: 20px;
}

.button:hover{
  text-decoration: none;
  background-color: #fff;
  color :#2BA8E2;
}
@media only screen and (max-width: 600px) {
    .columns {
        width: 100%;
}
.kotak {
	margin-bottom: 20px;
}
}
</style>
<div id="table-bg">


    <div class="intstruction-text">
        <br>
	<p>Hampir Selesai, Pilih Paket Langganan Yang Kamu Mau</p>
    </div>

<div id="table-section">
<div class="col-md-6 kotak" style="border-radius: 5px;">
<form action="{{ url('member/package')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="packages_id" value="1">
  <ul class="price">
    <li class="header">Pro</li>
    <hr>
    <li class="grey">Rp. <?=$packages['0']->price;?> /30 Hari</li>
    <li>Bebas Akses ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Chat Dengan Trainer dijawab dalam 3x24 Jam</li>
    <li></li>
    <li></li>
    <li></li>
    <hr>
    <li class=""><button type="submit" class="button">Pilih Paket</button></li>
  </ul>
</form>
</div>

<div class="col-md-6" style="border-radius: 5px;">
<form action="{{ url('member/package')}}" method="post">
{{ csrf_field() }}

<input type="hidden" name="packages_id" value="2">
  <ul class="price">
    <li class="header">Premium</li>
    <hr>
    <li class="grey">Rp. <?=$packages['1']->price;?> / <?=$packages['1']->expired;?> Hari</li>
    <li>Bebas Akses ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Chat Dengan Trainer dijawab dalam 1x24 Jam</li>
    <li>Download Semua Materi Video</li>
    <li>Download Berkas Praktek</li>
    <hr>
    <li class=""><button type="submit" class="button">Pilih Paket</button></li>
  </ul>
  </form>
</div>
</div>
    <div class="intstruction-text">
       <p>Butuh Bantuan Untuk Bertanya? Whatsapp Kami di 089630713487</p>
    </div>

</div>

<script type="text/javascript">
  function select_package(id) {
    $('[name=packages_id]').val(id);
  }
</script>
<script>
fbq('track', 'InitiateCheckout');
</script>
@endsection
