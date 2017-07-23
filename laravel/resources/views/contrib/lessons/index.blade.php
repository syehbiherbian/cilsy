@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <a href="{{ url('contributor/lessons/create')}}" class="btn btn-info pull-right">Buat Tutorial</a>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li>Kelola Tutorial</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
    
        <ul class="nav nav-tabs">
          <li class="<?php if($filter == "pending"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/pending/list') }}">Perlu Revisi</a></li>
          <li class="<?php if($filter == "processing"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/processing/list') }}">Sedang Diverifikasi</a></li>
          <li class="<?php if($filter == "publish"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/publish/list') }}">Sudah dipublish</a></li>
          <li class="<?php if($filter == "all"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/all/list') }}">Semua</a></li>
        </ul>

        <div class="tab-content">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Tutorial</th>
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>Revisi ke</th>
                  <th>Jumlah murid bulan ini</th>
                  <th>Jumlah view bulan ini</th>
                  <th>Lebih lanjut</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=1; $i < 6 ; $i++) { ?>
                <tr>
                  <td>{{ $i }}</td>
                  <td>Lorem Ipsum</td>
                  <td>Linux</td>
                  <td>Publish</td>
                  <td>0</td>
                  <td>100</td>
                  <td>17000</td>
                  <td><a href="#" class="btn btn-warning">Edit</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection()
