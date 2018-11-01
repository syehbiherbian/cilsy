@extends('contrib.app')
@section('title','')
<link href="{{asset('template/kontributor/summernote/summernote.css')}}" rel="stylesheet">
<style>
	#summernote{
		z-index:500;
	}
	#summergoal{
		z-index:500;
	}
</style>
@section('breadcumbs')

<div id="navigation">
		<ul class="breadcrumb">
			<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
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
	        <label class="col-sm-2 control-label">Harga</label>
	        <div class="col-sm-10">
	          <input type="text"  required class="form-control" placeholder="minimum : 10000" name="price" value="{{ $row->price }}">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Audiens</label>
						<div class="col-sm-10">
							<input type="text"  required class="form-control" placeholder="Newbie" name="audien" value="{{ $row->audiens }}">
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
						<label class="col-sm-2 control-label">Goal Tutorial</label>
						<div class="col-sm-10">
							<textarea id="summergoal" name="goal" value="{{ $row->goal }}"></textarea>
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
							<textarea id="summernote" name="description" value="{{ $row->description }}"></textarea>
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Requirement</label>
						<div class="col-sm-10">
								<textarea id="textedit" name="requirement" value="{{ $row->requirement }}"></textarea>
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
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
<script type="text/javascript" src="{{asset('template/kontributor/summernote/summernote.js')}}"></script>
<script>
	$('#summernote').summernote('code', '{!! $row->description !!}');
	$('#textedit').summernote('code', '{!! $row->requirement !!}');
	$('#summergoal').summernote('code', '{!! $row->goal !!}');
	$('#summernote').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,                  // set focus to editable area after initializing summernote 
	});
	$('#textedit').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
	$('#summergoal').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
</script>
@endsection()
