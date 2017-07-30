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
		<div class="box-white">
	    <div class="form-title">
	      <h3>Tutorial Linux Fundamental dengan ubuntu 14.04 LTS</h3>
	    </div>
	    <form class="form-horizontal">
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Judul</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" placeholder="Contoh: Kuis tahap pertama">
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Muncul Setelah Video</label>
	        <div class="col-sm-10">
	          <select class="form-control" name="">
	            <option value="">-</option>
	          </select>
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Deskripsi Kuis</label>
	        <div class="col-sm-10">
	        <textarea class="form-control" rows="8" cols="80" placeholder="Contoh: Ini adalah kuis tahap awal"></textarea>
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
</div>
@endsection()
