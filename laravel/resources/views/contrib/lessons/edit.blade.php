@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
			<li><a href="{{ url('contributor') }}">Dashboard</a></li>
            <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
            <li><a href="{{ url('contributor/lessons/'.$row->id.'/view') }}">View Tutorial</a></li>
            <li>Edit tutorial</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">
	    <div class="form-title">
	      <h3>Edit Tutorial</h3>
	    </div>
	    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
            <input type="hidden" name="method" value="PUT">
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Judul</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" placeholder="Contoh:Tutorial Administrasi Server dengan ubuntu 12.04" name="title" value="{{$row->title}}">
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Pilih Kategori</label>
	        <div class="col-sm-10">
	          <select class="form-control" name="category_id">
	            <option value="">-</option>
							<?php foreach ($categories as $key => $value): ?>

		                            <option value="{{ $value->id }}" <?php if($value->id==$row->category_id){echo 'selected="selected"';}?>>{{ $value->title }}</option>
							<?php endforeach; ?>
	          </select>
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Upload gambar</label>
	        <div class="col-sm-10">
	          <input type="file" name="image" class="form-control">
              <input type="hidden" name="image_text" value="{{$row->image}}" class="form-control">
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
	        <textarea class="form-control" rows="8" cols="80"  name="description" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."><?php  echo nl2br($row->description);?></textarea>
	        </div>
	      </div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10 text-right">
	          <a href="{{ url('contributor/lessons') }}" class="btn btn-danger">Batal</a>
			<button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
