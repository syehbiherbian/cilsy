@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
                <li>Komentar</li>
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
  <div class="col-md-12">
    <div id="exTab1" class="container">
      <ul  class="nav nav-pills">
        <li class="active">
          <a  href="#1a" data-toggle="tab">Unanswered</a>
        </li>
        <li><a href="#2a" data-toggle="tab">Answared</a>
        </li>
        <li><a href="#3a" data-toggle="tab">All</a>
        </li>

      </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
          <table class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th width="60%">Pertanyaan</th>
                <th>Lebih Lanjut</th>
              </tr>
            </thead>
            <tbody>
			@foreach($data as $dat)
			<?php
				$cekanswer = DB::table('coments')->where('parent',$dat->id)->count();
				if($cekanswer == 0){
			?>
              <tr>
                <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
                <td>{{ $dat->description }}</td>
                <td>
                   <a href="{{ url('contributor/coments/detail/'.$dat->id) }}" class="btn blue">Lihat</a>
                 	<a href="javascript:void(0)" class="btn red" onclick="$('#un{{ $dat->id }}').submit();">Abaikan</a>
					<form id="un{{ $dat->id }}" class="" action="{{ url('contributor/coments/deletecomment/'.$dat->id) }}" method="post">
						{{ csrf_field() }}
					</form>
                </td>
              </tr>
			<?php } ?>
			@endforeach
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="2a">
			<table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th width="60%">Pertanyaan</th>
                  <th>Lebih Lanjut</th>
                </tr>
              </thead>
              <tbody>
  			@foreach($data as $dat)
  			<?php
  				$cekanswer = DB::table('coments')->where('parent',$dat->id)->count();
  				if($cekanswer > 0){
  			?>
                <tr>
                  <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
                  <td>{{ $dat->description }}</td>
                  <td>
                     <a href="{{ url('contributor/coments/detail/'.$dat->id) }}" class="btn blue">Lihat</a>
                     <a href="javascript:void(0)" class="btn red" onclick="$an('#{{ $dat->id }}').submit();">Abaikan</a>
					 <form id="an{{ $dat->id }}" class="" action="{{ url('contributor/coments/deletecomment/'.$dat->id) }}" method="post">
						 {{ csrf_field() }}
					 </form>
                  </td>
                </tr>
			<?php } ?>
  			@endforeach
              </tbody>
            </table>
        </div>
        <div class="tab-pane" id="3a">
			<table class="table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th width="60%">Pertanyaan</th>
                  <th>Lebih Lanjut</th>
                </tr>
              </thead>
              <tbody>
  			@foreach($data as $dat)
            <tr>
              <td><?= date('d/m/Y',strtotime($dat->created_at)) ?></td>
              <td>{{ $dat->description }}</td>
              <td>
                 <a href="{{ url('contributor/coments/detail/'.$dat->id) }}" class="btn blue">Lihat</a>
                 <a href="javascript:void(0)" class="btn red" onclick="$('#all{{ $dat->id }}').submit();">Abaikan</a>
				 <form id="all{{ $dat->id }}" class="" action="{{ url('contributor/coments/deletecomment/'.$dat->id) }}" method="post">
					 {{ csrf_field() }}
				 </form>
              </td>
            </tr>
  			@endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection()
