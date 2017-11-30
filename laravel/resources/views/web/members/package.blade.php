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
<div class="col-md-4 kotak" style="border-radius: 5px;">
<form action="{{ url('member/package')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="packages_id" value="1">
  <ul class="price">
    <li class="header">Pro</li>
    <hr>
    <li class="grey">Rp. <?=$packages['0']->price;?> / <?=$packages['0']->expired;?> Hari<br><br></li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan trainer via chat dijawab max dalam 3x24 Jam</li>
    <li><strike><font color="red">Download Semua Materi Video</font></strike></li>
    <li><strike><font color="red">Download Ebook & File Praktek</font></strike></li>
    <li><strike><font color="red">Support Remote Teamviewer</font></strike></li>    
    <li></li>
   <hr>
    <li class=""><button type="submit" class="button" id="pilih">Pilih Paket</button></li>
  </ul>
</form>
</div>

<div class="col-md-4" style="border-radius: 5px;">
<form action="{{ url('member/package')}}" method="post">
{{ csrf_field() }}

<input type="hidden" name="packages_id" value="2">
  <ul class="price">
    <li class="header">Premium <font color="red">Disc 10%!</font></li>
    <hr>
    <li class="grey">Rp. <?=$packages['1']->price;?> / <?=$packages['1']->expired;?> Hari
    <br><strike><font color="red"><font size="2">Rp. 349000</strike> | Hemat 162.000!</font></font></li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan trainer via chat dijawab max dalam 2x24 Jam</li>
    <li>Download Semua Materi Video</li>
    <li>Download Ebook & File Praktek</li>
    <li><strike><font color="red">Support Remote Teamviewer</font></strike></li>
    <li></li>
    <hr>
    <li class=""><button type="submit" class="button" id="pilih">Pilih Paket</button></li>
  </ul>
  </form>
</div>
<div class="col-md-4" style="border-radius: 5px;">
<form action="{{ url('member/package')}}" method="post">
{{ csrf_field() }}

<input type="hidden" name="packages_id" value="3">
  <ul class="price">
    <li class="header">Platinum <font color="red">Disc 10%!</font></li>
    <hr>
    <li class="grey">Rp. <?=$packages['2']->price;?> / <?=$packages['2']->expired;?> Hari
    <br><strike><font color="red"><font size="2">Rp. 499000</strike> | Hemat 265.000!</font></font></li>
    <li>Bebas Streaming ke Semua Video Tutorial</li>
    <li>Update Hingga 50 Video lebih perbulan</li>
    <li>Konsultasi dengan Trainer via chat dijawab max dalam 1x24 Jam</li>
    <li>Download Semua Materi Video</li>
    <li>Download Berkas Praktek</li>
    <li>Support Remote Teamviewer (Kuota remote 2x perbulan, durasi per-remote 1 jam)</li>
    <hr>
    <li class=""><button type="submit" class="button" id="pilih">Pilih Paket</button></li>
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
fbq('track', 'CompleteRegistration');
</script>
<script type="text/javascript">
  var button = document.getElementById('pilih');
  button.addEventListener(
    'click',
    function() {
      fbq('track', 'InitiateCheckout');
    },
    false
  );
</script>
@endsection
