@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
        <li>Buat tutorial</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="form-title">
      <h3>Buat Tutorial</h3>
    </div>
    <form class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">Judul</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Contoh:Tutorial Administrasi Server dengan ubuntu 12.04">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Pilih Kategori</label>
        <div class="col-sm-10">
          <select class="form-control" name="">
            <option value="">-</option>
            <option value="">Linux</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Upload gambar</label>
        <div class="col-sm-10">
          <input type="file" name="" value="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
        <textarea class="form-control" rows="8" cols="80" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
          <a class="btn btn-danger">Batal</a>
          <a class="btn btn-info">Submit</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection()
