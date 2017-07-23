@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/create') }}">Buat tutorial</a></li>
        <li>Video</li>
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
				<div class="item">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4>1.Video 1</h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
								  <button type="button" class="btn btn-default"><i class=""></i></button>
								  <button type="button" class="btn btn-default"><i class=""></i></button>
								  <button type="button" class="btn btn-default"><i class=""></i></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Contoh:Pengenalan dasar terminal Ubuntu">
						</div>
					</div>
					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih Video</label>
					 <div class="col-sm-10">
						 <input type="file" class="form-control" name="">
					 </div>
				 </div>
	 	      <div class="form-group">
	 	        <label class="col-sm-2 control-label">Description</label>
	 	        <div class="col-sm-10">
	 	        <textarea class="form-control" rows="8" cols="80" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>
	 	        </div>
	 	      </div>

				</div>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" class="btn btn-info"><i class=""></i>tambah video</button>
					</div>
	        <div class="col-sm-10 text-right">
	          <a class="btn btn-danger">Batal</a>
	          <a class="btn btn-info">Submit</a>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
