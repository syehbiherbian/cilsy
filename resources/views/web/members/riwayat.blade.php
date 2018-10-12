@extends('web.members.master')
@section('title','Riwayat Pembelian | ')
@section('member-content')
<style>
    .borderless td, .borderless th, .borderless thead {
        border: none;
    }
</style>
<div class="col-md-12">
    <h4>Pembelian Dalam Proses</h4>
</div><br><br>

@foreach($get_hist as $get_hist => $cari)
    @if(!empty($cari->type) )
<div class="panel panel-default">

    <div class="panel-body">
  
        <div class="col-md-6">
            <h6>{{$cari->invoice}}</h6>
            <p>{{$cari->hari}}</p>
        </div>
        <div class="col-md-6 ">
            <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/petunjuk')}}" >
                Cara Pembayaran
            </a><br><br>
            <?php if($cari->disc == 0){?>
                <?php }else{ ?>
              <p class="pull-right">Potongan Diskon : {{$cari->disc}}</p><br><br>
              <?php } ?>
            <p class="pull-right">Total Bayar: {{$cari->total}}</p>         

        </div>

        <table class="table borderless">
                <thead>
                    <tr>
                    <th colspan="2">Rincian</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    </tr>
                </thead>
            @if(!is_array($cari))
            <?php
                  $getdos = DB::table('invoice')
                  ->join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
                  ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
                  ->where('invoice.code', '=', $cari->invoice)
                  ->where('B.harga_lesson', '<>', '0')
                  ->orderBy('invoice.created_at', 'desc')
                  ->distinct()
                  ->select(['invoice.code as invoice' , 'invoice.created_at as hari', 'C.title as title', 'B.harga_lesson as harga', 'invoice.type as type', 
                  DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', 'invoice.price as total'])
                  ->get();
				?>
                @foreach($getdos as $tes) 
                <tbody>
                    <tr>
                        <td colspan="2">{{$tes->title}}</td>
                        <td>{{$tes->harga}}</td>
                        <td>{{$tes->type}}</td>
                        <td><i class="fa fa-checklist"></i><?php if($tes->status == "2"){?> Waiting Payment <?php } ?> </td>
                    </tr>
                </tbody>
            @endforeach
            @endif
        </table>
        <div class="alert alert-info" style="background-color:white; color:#5bc0de;" role="alert">
				<b>Batas Pembayaran : {{$cari->batas}} </b>
		</div>
    </div>
 
  </div>
   @endif
@endforeach


  <div class="col-md-12">
        <h4>Pembelian Sebelumnya</h4>
    </div><br><br>
    @foreach($get_tot as $get_tot => $cari)
    @if(!empty($cari->type) )
    <div class="panel panel-default">

    <div class="panel-body">
  
        <div class="col-md-6">
            <h6>{{$cari->invoice}}</h6>
            <p>{{$cari->hari}}</p>
        </div>
        <div class="col-md-6 ">
        <!-- <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/member/invoice/'.$cari->invoice)}}" >
                Download Invoice
                </a><br><br> -->
              <?php if($cari->status == 1){?>
                <a class="btn pull-right" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; " href="{{ url('/member/invoice/'.$cari->invoice)}}" >
                Download Invoice
                </a><br><br>
              <?php }else if($cari->status == 5 || $cari->status == 4){ ?>
                <ul class="left" style="margin-left: 218px;">
                <!-- <button id="{{ $cari->invoice }}" type="button" class="btn btn-info" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; "  onclick="riway({{ $cari->invoice }})"><i class="fa fa-shopping-cart"></i>Beli Lagi</button> -->
                </ul>
              <?php } ?>
              <?php if($cari->disc == 0){?>
                <?php }else{ ?>
              <p class="pull-right">Potongan Diskon : {{$cari->disc}}</p><br><br>
              <?php } ?>
              <p class="pull-right">Total Bayar: {{$cari->total}}</p>
 
        </div>
       
        <table class="table borderless">
                <thead>
                    <tr>
                    <th colspan="2">Rincian</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <?php if($cari->status == 5 || $cari->status == 4){?>
                    <th> </th>
                    <?php } ?>
                    </tr>
                </thead>
            @if(!is_array($cari))
            <?php
                  $getdos = DB::table('invoice')
                  ->join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
                  ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
                  ->leftjoin('tutorial_member', function($join){
                    $join->on('C.id', '=', 'tutorial_member.lesson_id')
                    ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
                  ->where('invoice.code', '=', $cari->invoice)
                  ->where('B.harga_lesson', '<>', '0')
                  ->orderBy('invoice.created_at', 'desc')
                  ->distinct()
                  ->select(['C.id as id', 'C.slug as slug', 'tutorial_member.id as ada', 'invoice.code as invoice' , 'invoice.created_at as hari', 'C.title as title', 'B.harga_lesson as harga', 'invoice.type as type', 
                  DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', 'invoice.price as total'])
                  ->get();
				?>
                @foreach($getdos as $tes) 
                <tbody>
                    <tr>
                        <td colspan="2">{{$tes->title}}</td>
                        <td>{{$tes->harga}}</td>
                        <td>{{$tes->type}}</td>
                        <td>
                        <?php if($tes->status == "1"){?> 
                        Selesai <?php }else if($tes->status == "5" || $tes->status == "4"){ ?> dibatalkan <?php }?>
                        </td>
                        
                        <?php 
                        if(!empty($tes->ada)){
                        ?>
                        <td>
                        <!-- <a href="{{ url('kelas/v3/'.$tes->slug) }}" class="btn pull-right" style="background-color:#f1c40f; color:white; padding: 6px 22px;">
                        Lihat tutorial
                        </a> -->
                        sudah memiliki
                        </td>
                         <?php }else{
                        if($tes->status == 5 || $tes->status == 4){ ?>
                        <td>
                        <button id="{{ $tes->id }}" type="button" class="btn btn-info" style="background-color:#fff; color:#5bc0de; border-color:#46b8da; padding: 6px 31px; "  onclick="addToCart({{ $tes->id }})"><i class="fa fa-shopping-cart"></i>Beli Lagi</button>
                        </td>
                        <?php }} ?>
                    </tr>
                </tbody>
            @endforeach
            @endif
        </table>
        
    </div>
 
  </div>
@endif
@endforeach

 <script>
function riway(comment_id){
        var  invoice = '{{ $cari->invoice }}';
        var datapost = {
            '_token'    : '{{ csrf_token() }}',
            'invoice' : invoice
        }

        $.ajax({
            type    :'POST',
            url     :'{{ url("member/tambah/") }}',
            data    :datapost,
            success:function(data){
                if (data == 1) {
                    $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                }
                else if(data==0){
                        window.location.href = '{{url("member/signin")}}';
                }else {
                    alert('Koneksi Bermasalah, Silahkan Ulangi');
                    location.reload();
                }
            }
        })
    }

</script>
@endsection