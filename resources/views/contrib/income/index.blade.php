@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li>Kelola Pendapatan</li>
		</ul>
</div>
@endsection
@section('content')
<style>
  #content{
    background: #f4f4f4;
  }
  #exTab1 .nav-pills{
      background: #fff;
  }
  #exTab1 .tab-content {

    background-color: #fff;
    padding : 5px 15px;
  }
  #exTab1 .nav-pills > li > a {
  border-radius: 0;
  background: #fff;
  color: #2BA8E2;
  }
  #exTab1 .nav-pills  .active{
    border-bottom: 2px solid #2BA8E2;
  }


.btn {
  border-radius: 3px;
  padding: 5px 20px;
  font-size: 13px;
  text-decoration: none;
  color: #fff;
  position: relative;
  display: inline-block;
}

.blue {
  background-color: #55acee;
}
.blue:hover {
  background-color: #fff;
  border-color: #55acee;
  color: #55acee;
}

.red {
  background-color: #e74c3c;
}
.red:hover{
  background-color: #fff;
  border-color: #e74c3c;
  color: #e74c3c;
}
#content {
    padding: 160px 0px 0px 0px;
    min-height: calc(100vh - 235px);
}
</style>
<div class="row">
	<div class="col-sm-12">
		@if($errors->all())
		 <div class="alert\ alert-danger">
			 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			 <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
			 @foreach($errors->all() as $error)
			 <?php echo $error."</br>";?>
			 @endforeach
		 </div>
		 @endif
		 @if(Session::has('success'))
			 <div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				 <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
				 {{ Session::get('success') }}
			 </div>
		 @endif

		@if(Session::has('success-delete'))
		  <div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
			  {{ Session::get('success-delete') }}
		  </div>
		@endif
		@if(Session::has('no-delete'))
		  <div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
			  {{ Session::get('no-delete') }}
		  </div>
		@endif
	</div>

@if(count($row) ==0)
    <div class="col-md-4 col-md-offset-4">
        <div class="card bg-3">
            <img src="{{asset('template/kontributor/img/icon/2.png')}}" alt="" />
            <p class="card-title">Rp. 0</p>
            <p class="card-desc">Pendapatan Bulan ini</p>
        </div>
    </div>

@else
</div>
<div class="col-md-4 col-md-offset-4">
	<div class="card bg-3">
		<img src="{{asset('template/kontributor/img/icon/2.png')}}" alt="" />
		<p class="card-title">Rp. <?php echo number_format($row->total_income,0,",",".") ;?></p>
		<p class="card-desc">Pendapatan Bulan ini</p>
	</div>
</div>
<div class="row">
  <div id ="exTab1"class="col-md-12">
      <div class="tab-content clearfix">
          <h3>Pendapatan</h3>
          <div class="row">
              <div class="col-sm-3">
                 <div class="title"><h4>Pendapatan Bulan<h4></div>
                 <div class="value" style="margin-top:18px;">

                     @if($row->moth=='01')
                     Januari
                     @elseif($row->moth=='02')
                     Februari
                     @elseif($row->moth=='03')
                     Maret
                     @elseif($row->moth=='04')
                     April
                     @elseif($row->moth=='05')
                     Mei
                     @elseif($row->moth=='06')
                     Juni
                     @elseif($row->moth=='07')
                     Juli
                     @elseif($row->moth=='08')
                     Agustus
                     @elseif($row->moth=='09')
                     September
                     @elseif($row->moth=='10')
                     Oktober
                     @elseif($row->moth=='11')
                     November
                     @elseif($row->moth=='12')
                     Desember
                     @else
                     -
                     @endif
                 </div>
              </div>
              <div class="col-sm-3">
                 <div class="title"><h4>Jumlah<h4></div>
                 <div class="value" style="margin-top:18px;">Rp. <?php echo number_format($row->total_income,0,",",".") ;?></div>
              </div>
              <div class="col-sm-3">
                 <div class="title"><h4>Status<h4></div>
                 <div class="value" style="margin-top:18px;">@if($row->status=='1')Paid @else Unpaid @endif</div>
              </div>
              <div class="col-sm-3">
                 <div class="title"><h4>Tanggal Dibayar<h4></div>
                 <div class="value" style="margin-top:18px;">

									 <?php if($row->transfer_date ==null || $row->transfer_date=='0000-00-00'){echo "-"; }else{echo date('d F Y',strtotime($row->transfer_date));}?>

								 </div>
              </div>

          </div>
          <div class="row">
              <div class="col-sm-12" style="margin-top:20px;margin-bottom:20px;">
                <a href="{{url('contributor/income/view-all')}}" class="btn btn-info pull-right">Selengkapnya</a>
              </div>
          </div>
      </div>
  </div>
</div>

@endif
<div class="row" style="margin-top:20px;">
  <div id ="exTab1"class="col-md-12">
      <div class="tab-content clearfix">

          <div class="row">
              <div class="col-sm-9">
                    <h3>Info Rekening</h3>
              </div>

              <div class="col-sm-3" style="margin-top:20px;">

                <a href="{{url('contributor/income/account/create')}}" class="btn btn-info pull-right">Tambah</a>
              </div>
          </div>
          <div class="row"style="margin-bottom:30px;">
              <div class="col-sm-3">
                 <div class="title"><h4>Nama Bank<h4></div>
                  @foreach($rekening as $reg)
                    <div class="value" style="margin-top:18px;">{{$reg->bank}}</div>
                  @endforeach
              </div>
              <div class="col-sm-3">
                 <div class="title"><h4>No Rekening<h4></div>
                 @foreach($rekening as $reg)
                   <div class="value" style="margin-top:18px;">{{$reg->account_no}}</div>
                 @endforeach
              </div>
              <div class="col-sm-4">
                 <div class="title"><h4>Nama Penerima<h4></div>
                 @foreach($rekening as $reg)
                   <div class="value" style="margin-top:18px;">{{$reg->holder}}</div>
                 @endforeach
              </div>
              <div class="col-sm-1">
				  <div class="title" style="color:#fff;">.</div>
                 @foreach($rekening as $reg)
                  <a  href="{{url('contributor/income/account/'.$reg->id.'/edit')}}" class="btn btn-info pull-right" style="margin-top:15px;">Edit</a>
                   @endforeach
              </div>
			  <div class="col-sm-1">
				<div class="title" style="color:#fff;">.</div>
				 @foreach($rekening as $reg)
				  <form id="{{ $srow->id }}" action="{{url('contributor/income/account/'.$reg->id.'/delete')}}" method="get">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="DELETE">
						<button type="button"  title="Hapus Rekening" data-toggle="tooltip" class="btn btn-danger pull-right"style="margin-top:15px;" data-toggle="tooltip" onclick="checkdelete({{$srow->id}})">Hapus</button>
				  </form>
				  @endforeach
			  </div>
          </div>
      </div>
  </div>
</div>

<script>
 function checkdelete(id){

   swal({
     title: "Apakah kamu yakin?",
     text: "Anda tidak akan dapat memulihkan data ini!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Hapus Rekening!",
     cancelButtonText: "Tidak, Batalkan!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {

       $('#'+id).submit();

       swal("Deleted!", "Data Anda telah dihapus.", "success");
     } else {
       swal("Cancelled", "Data Anda aman :)", "error");
     }
     });
 }
 </script>
@endsection()
