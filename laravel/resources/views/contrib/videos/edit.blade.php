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

<!-- BEGIN ALERT -->
<div class="row">
  <div class="col-md-12">
    @include('contrib.include.alert')
  </div>
</div>
<!-- END ALERT -->

<div class="row">
  <div class="col-md-12">
		<div class="box-white">

	    <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-title">
					<h3>{{ $lessons->title }}</h3>
			 	</div>
				<?php foreach ($videos as $key => $row): ?>
					<div class="item">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4>1.Video 1</h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
								  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>
								  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>
								  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Contoh:Pengenalan dasar terminal Ubuntu" name="title[]" value="{{ $row->title }}">
						</div>
					</div>
					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih Video</label>
					 <div class="col-sm-10">
						 <video src="{{ $row->title }}" autoplay poster="posterimage.jpg"></video>
						 <input type="file" class="form-control" name="video[]">
					 </div>
				 </div>
	 	      <div class="form-group">
	 	        <label class="col-sm-2 control-label">Description</label>
	 	        <div class="col-sm-10">
	 	        <textarea class="form-control" rows="8" cols="80" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows." name="description[]">{{ $row->description }}</textarea>
	 	        </div>
	 	      </div>

				</div>

				<?php endforeach; ?>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" class="btn btn-default btn-outline" id="btn-add"><i class=""></i>tambah video</button>
					</div>
	        <div class="col-sm-10 text-right">
	          <a class="btn btn-danger">Batal</a>
	          <button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@push('js')

<script type="text/javascript">
$('#btn-add').on('click',function() {

	var html = '<div class="item">'
						+ '<div class="option">'
						+ '	<div class="row">'
						+ '		<div class="col-md-6">'
						+ '			<h4>1.Video 1</h4>'
						+ '		</div>'
						+ '		<div class="col-md-6 text-right">'
						+ '			<div class="btn-group">'
						+ '			  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>'
						+ '			  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>'
						+ '			  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>'
						+ '			</div>'
						+ '		</div>'
						+ '	</div>'
						+ '</div>'

						+ '<div class="form-group">'
						+ '	<label class="col-sm-2 control-label">Judul</label>'
						+ '	<div class="col-sm-10">'
						+ '		<input type="text" class="form-control" placeholder="Contoh:Pengenalan dasar terminal Ubuntu" name="title[]">'
						+ '	</div>'
						+ '</div>'
						+ '<div class="form-group">'
						+ ' <label class="col-sm-2 control-label">Pilih Video</label>'
						+ ' <div class="col-sm-10">'
						+ '	 <input type="file" class="form-control" name="video[]">'
						+ '</div>'
					  + '</div>'
		 	      + '<div class="form-group">'
		 	      + '  <label class="col-sm-2 control-label">Description</label>'
		 	      + '  <div class="col-sm-10">'
		 	      + '  <textarea class="form-control" rows="8" cols="80" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows." name="description[]"></textarea>'
		 	      + '  </div>'
		 	      + '</div>'
						+ '</div>';

	 $(".item").append(html);
});


</script>
@endpush
@endsection()
