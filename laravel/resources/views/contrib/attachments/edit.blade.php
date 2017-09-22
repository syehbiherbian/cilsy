@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$lesson->id.'/view') }}">View Lampiran</a></li>
        <li>Lampiran</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">

	    <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-title">
					<h3>{{$lesson->title}}</h3>
			 	</div>
				<?php $i=0;?>
				@if(count($files)==0)
				<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all">
				@endif
				@foreach($files as $value)
				<?php $n= $i + 1; ?>
		        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
					<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4><?php echo $i; ?>.Lampiran <?php echo $i; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
								  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>
								  <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>
								  <button type="button" class="btn btn-default btn-outline btn_remove" id="{{$i}}" ><i class=""></i></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="judul[]" id="judul{{$i}}" value="{{$value->title}}"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>
						</div>
					</div>

					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih lampiran</label>
					 <div class="col-sm-10">
						 <input type="file" class="form-control" name="files[]" id="files{{$i}}" >
						 <input type="hidden" name="files_text[]" id="files_text{{$i}}" value="{{$value->source}}" class="form-control">
					 </div>
				 	</div>
	 	      <div class="form-group">
	 	        <label class="col-sm-2 control-label">Description</label>
	 	        <div class="col-sm-10">
	 	        <textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc{{$i}}" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."><?php echo nl2br($value->description);?></textarea>
	 	        </div>
	 	      </div>
			</div>

			@endforeach
			<div class="row" id="dynamic_field">

			</div>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button"  id="addanswer" name="button" class="btn btn-default btn-outline"><i class=""></i>tambah lampiran</button>
					</div>

	      </div>
		  <div class="form-group">

		   <div class="col-sm-12 text-right">
			 <a href="{{url('contributor/lessons/'.$lesson->id.'/view')}}"class="btn btn-danger">Batal</a>
			  <button type="submit" class="btn btn-info">Submit</button>
		   </div>
		 </div>
	    </form>
		</div>
  </div>
</div>


<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
<script>
     $(document).ready(function(){

          var count="{{$count_files}}";
		  var i= parseInt(count);
          $('#addanswer').click(function(){
			   var no= $('.count-all').last().val();
			   n=parseInt(no) + 1;
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
			   '<div class="item">'+
			   	 '<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all">'+
				   '<div class="option">'+
					   '<div class="row">'+
						   '<div class="col-md-6">'+
							   '<h4 class="no'+n+'">'+n+'.Lampiran '+n+'</h4>'+
						   '</div>'+
						   '<div class="col-md-6 text-right">'+
							  ' <div class="btn-group">'+
								 '<button type="button" class="btn btn-default btn-outline"><i class=""></i></button>'+
								' <button type="button" class="btn btn-default btn-outline"><i class=""></i></button>'+
								' <button type="button" class="btn btn-default btn-outline btn_remove " id="'+n+'"><i class=""></i></button>'+
							  ' </div>'+
						  ' </div>'+
					   '</div>'+
				   '</div>'+

				   '<div class="form-group">'+
					   '<label class="col-sm-2 control-label">Judul</label>'+
					   '<div class="col-sm-10">'+
						   '<input type="text" class="form-control" name="judul[]" id="judul'+n+'"placeholder="Contoh:Pengenalan dasar terminal Ubuntu" required>'+
					   '</div>'+
				   '</div>'+

				  ' <div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih lampiran</label>'+
					'<div class="col-sm-10">'+
						'<input type="file" class="form-control" name="files[]" id="files'+n+'">'+
						'<input type="hidden" name="files_text[]" id="files_text'+n+'" value="" class="form-control">'+
					'</div>'+
				'</div>'+
			 '<div class="form-group">'+
			   '<label class="col-sm-2 control-label">Description</label>'+
			   '<div class="col-sm-10">'+
			   '<textarea class="form-control" rows="8" cols="80" name="desc[]" id="desc'+n+'" placeholder="Contoh: Active Directory Domain Controller merupakan salah satu keunggulan server windows."></textarea>'+
			   '</div>'+
			 '</div>'+
		   '</div>'+
			  '</div>');

          });
          $(document).on('click', '.btn_remove', function(){
               var button_id = $(this).attr("id");
			   $(".count-all").each(function(){
				  var idrow=$(this).val();
				  if(idrow > button_id){
					  var hitung = parseInt(idrow)-1;
					  $('.no'+idrow).html(hitung+'.Lampiran '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
