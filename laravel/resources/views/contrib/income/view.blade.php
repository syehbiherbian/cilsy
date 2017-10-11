@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('contributor/income') }}">Kelola Pendapatan</a></li>
        <li>Selengkapnya</li>
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
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: none;
    border-bottom: 1px solid #ddd;
}
.table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>th {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: none;
  border: none;
}

.btn {
  border-radius: 10px;
  padding: 5px 20px;
  font-size: 10px;
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
</style>
<div class="row">
  <div id="exTab1"  class="col-md-12">

      <div class="tab-content clearfix">
        <h4>Selengkapnya Pendapatan Sebelumnya</h4>
        <div class="tab-pane active" id="1a">
          <table class="table">
            <thead>
              <tr>
                <th>Pendapatan Bulan</th>
                <th >Jumlah</th>
                <th>Status</th>
                <th>Tanggal dibayar</th>
              </tr>
            </thead>
            <tbody>
                @foreach($row as $value)
              <tr>
                <td>
                    @if($value->moth=='01')
                    Januari
                    @elseif($value->moth=='02')
                    Februari
                    @elseif($value->moth=='03')
                    Maret
                    @elseif($value->moth=='04')
                    April
                    @elseif($value->moth=='05')
                    Mei
                    @elseif($value->moth=='06')
                    Juni
                    @elseif($value->moth=='07')
                    Juli
                    @elseif($value->moth=='08')
                    Agustus
                    @elseif($value->moth=='09')
                    September
                    @elseif($value->moth=='10')
                    Oktober
                    @elseif($value->moth=='11')
                    November
                    @elseif($value->moth=='12')
                    Desember
                    @else
                    -
                    @endif
                </td>
                <td>Rp. <?php echo number_format($value->total_income,0,",",".") ;?></td>
                <td>@if($value->status=='1')Paid @else Unpaid @endif</td>
                <td><?php if($value->date_pay !==null || $value->date_pay=='0000-00-00'){ echo date('d F Y',strtotime($value->date_pay));}else{echo "-";}?></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

  </div>
</div>
@endsection()
