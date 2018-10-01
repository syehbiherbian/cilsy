@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<style>
	#form-upload {
		font-size: 24px;
		position: relative;
		padding: 20px 20px;
		text-align: center;
		border: 2px dashed transparent
	}
	* {

		-webkit-transition: none!important;
		transition: unset!important
	}

	#file, #drop-icon, #draggable-text {
		display: none
	}

	#drop-icon {
		font-size: 72px;
		border: 2px dashed #000;
		border-radius: 5px;
		padding: 10px 20px;
		display: block!important;
		width: 110px;
		margin: 0 auto;
	}

	.is-draggable #drop-icon, .is-draggable #draggable-text {
		display: inline
	}
	.is-draggable #video-text {
		display: none;
	}

	.is-dragover {
		border: 2px dashed #eee !important;
		border-radius: 5px;
	}

	#form-starter {
		cursor: pointer;
	}
	#file+label:hover strong,
	#file:focus+label strong,
	#file.has-focus+label strong {
		color: #39bfd3;
		cursor: pointer;
		text-decoration: underline;
		text-decoration-style: dashed
	}

	.thumbnail {
		margin-bottom: 0;
	}

	.durasi {
		font-size: 12px;
	}
	
	.bar {
		height: 20px;
		background: #ccc;
	}
	#file-list .videos:first-child {
		margin-top: 0;
	}
	#file-list .videos {
		border: 1px solid #ccc;
		border-radius: 5px;
		margin-top: 50px;
	}
</style>
<div id="navigation">
	<ul class="breadcrumb">
		<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
		<li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
		<li><a href="{{ url('contributor/lessons/'.$lesson->id.'/view') }}">View Video</a></li>
		<li>Video</li>
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
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				{{ Session::get('success') }}
			</div>
			@endif
		@if(Session::has('success-delete'))
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
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
			<h3>{{$lesson->title}}</h3>
		</div>
		<form id="form-upload" class="form-horizontal form-contributor" enctype="multipart/form-data">
			<input class="input-files" type="file" name="files[]" id="file" multiple />
			<label id="form-starter" for="file">
				<span id="drop-icon" class="fa fa-angle-double-down"></span><br>
				<strong>Pilih<span id="video-text"> video</span></strong>
				<span id="draggable-text"> atau tarik video ke sini</span>
			</label>
			<div id="file-list"></div>
		</form>
	</div>
  </div>
</div>
<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/kontributor/js/jquery-ui.min.js')}}"></script>
<script>
	$( function() {
		$( "#file-list" ).sortable();
		$( "#file-list" ).disableSelection();
	});

	var $form = $('#form-upload');
	var nVideo = 0;

	$(document).ready(function(){
		$('#file').on('change', function(e) {
			generateList(e.target.files);
		})
		/* aktifkan fitr drag n' drop */
		if (isAdvancedUpload) {
			$form.addClass('is-draggable');

			var droppedFiles = false;

			$form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
					e.preventDefault();
					e.stopPropagation();
				})
				.on('dragover dragenter', function() {
					$form.addClass('is-dragover');
				})
				.on('dragleave dragend drop', function() {
					$form.removeClass('is-dragover');
				})
				.on('drop', function(e) {
					droppedFiles = e.originalEvent.dataTransfer.files;
					generateList(droppedFiles);
				});
		}
	})

    /* cek fitur drag n' drop */
    var isAdvancedUpload = function() {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    }();

	/* generate dropped/selected files */
	var generateList = function(files) {
		/* sembunyikan tampilan form utama */
		$('#form-starter').hide();

		/* generate masing2 file */
		$.each(files, function(i, v) {
			/* siapkan variable */
			var title = v.name.split('.').slice(0, -1).join('.');
			var extension = v.name.split('.').pop();
			var extension2 = v.type ? v.type.split('/').pop() : '';

			/* validasi awal */
			if (extension != 'mp4' && extension2 != 'mp4') {
				alert('harus mp4');
				return
			}

			/* siapkan html */
			var html = '';
			html += '<div id="video' + nVideo + '" class="row nVideo">'+
				'<input id="id' + nVideo + '" type="hidden" name="id[]">'+
				'<div class="col-md-12" style="padding:0">'+
					'<div id="progress' + nVideo + '" class="progress">'+
						'<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">'+
							'<span class="nilai-persen">0</span>%'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-12">'+
					'<div class="col-md-3">'+
						'<div id="thumbnail' + nVideo + '" class="thumbnail">'+
							'Menunggu gambar..'+
						'</div>'+
						'<span class="durasi">Durasi: <span id="waktu-durasi' + nVideo + '">...</span></span>'+
					'</div>'+
					'<div class="col-md-9">'+
						'<div class="form-group">'+
							'<input name="title[]" class="form-control" placeholder="Judul (Contoh: Pengenalan dasar terminal Ubuntu)" value="' + title + '">'+
						'</div>'+
						'<div class="form-group">'+
							'<textarea name="description[]" rows="11" class="form-control" placeholder="Deskripsi (Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows.)"></textarea>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>';

			/* tampilkan ke form */
			$('#file-list').append(html);
			nVideo++;
		});

		/* munculkan kembali jika tidak ada video yang ditampilkan */
		if (!nVideo) {
			$('#form-starter').show();
		}

		/* aktifkan sortable */
		// $('#file-list').sortable();
	}

	var uploadVideo = function(file) {
		
	}

	$(function() {
      var group = $('#file-sort').sortable();
    });
</script>
@endsection()
