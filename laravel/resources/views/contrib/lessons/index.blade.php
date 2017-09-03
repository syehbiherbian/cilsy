@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        <a href="{{ url('contributor/lessons/create')}}" class="btn btn-info pull-right">Buat Tutorial</a>
            <ul class="breadcrumb">
                    <li><a href="{{ url('contributor') }}">Dashboard</a></li>
            <li>Kelola Tutorial</li>
            </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
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

        <ul class="nav nav-tabs">
          <li class="<?php if($filter == "pending"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/pending/list') }}">Draft</a></li>
          <li class="<?php if($filter == "processing"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/processing/list') }}">Sedang Diverifikasi</a></li>
          <li class="<?php if($filter == "publish"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/publish/list') }}">Sudah dipublish</a></li>
          <li class="<?php if($filter == "revision"){ echo "active";} ?>"><a href="{{ url('contributor/lessons/revision/list') }}">Perlu Revisi</a></li>
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
                <?php if (count($data) == 0): ?>
                  <tr>
                    <td colspan="8">Tidak Ada data</td>
                  </tr>
                <?php else: ?>
                <?php $i = 1; ?>
                <?php foreach ($data as $key => $row): ?>
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $row->title }}</td>
                  <td>{{ $row->category_title }}</td>
                  <td>
                    <?php if ($row->status == 0): ?>
                      <div class="label label-warning">Draft</div>
                    <?php elseif($row->status == 1): ?>
                        <div class="label label-success">Publish</div>
                    <?php elseif($row->status == 2): ?>
                        <div class="label label-info">Proses</div>
                    <?php elseif($row->status == 3): ?>
                        <div class="label label-warning">Revisi</div>
                    <?php endif; ?>
                  </td>
                  <td>{{$row->revisi_ke}}</td>
                  <td>@if($row->student=='') 0 @else {{$row->student}}  @endif</td>
                  <td>@if($row->view=='') 0 @else {{$row->view}}  @endif</td>
                  <td><a href="{{ url('contributor/lessons/'.$row->id.'/view')}}" class="btn btn-warning">View</a></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection()
