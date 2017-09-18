@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
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
	    <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-title">
					<h3>{{$lesson->title}}</h3>
			 	</div>
				<?php $i=0;?>

				<input type="hidden" name="count0" value="0" class="count-all">

				@foreach($video as $value)
				<?php $n= $i + 1; ?>
		        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
				<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all get<?php echo $i; ?>" rowname="<?php echo $i; ?>">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4 class="no<?php echo $i; ?>"><?php echo $i; ?>.Video <?php echo $i; ?></h4>
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
					 <label class="col-sm-2 control-label">Pilih Image</label>
					 <div class="col-sm-10">
						 <input type="file" class="form-control" name="image[]" id="image{{$i}}" >
						 <input type="hidden" name="image_text[]" id="image_text{{$i}}" value="{{$value->image}}" class="form-control">
					 </div>
					</div>
					<div class="form-group">
					 <label class="col-sm-2 control-label">Pilih Video</label>
					 <div class="col-sm-10">
						 <input type="file" class="form-control" name="video[]" id="video{{$i}}" >
						  <input type="hidden" name="video_text[]" id="video_text{{$i}}" value="{{$value->video}}" class="form-control">
						   <input type="hidden" name="type_video[]" id="type_video{{$i}}" value="{{$value->type_video}}" class="form-control">
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
						<button type="button"  id="addanswer" name="button" class="btn btn-default btn-outline"><i class=""></i>tambah video</button>
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

          var count="{{$count_video}}";
		  var i= parseInt(count);
          $('#addanswer').click(function(){
			   var no= $('.count-all').last().val();
			   n=parseInt(no) + 1;
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
			   '<div class="item">'+
			   	'<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all get'+n+'" rowname="'+n+'">'+
				   '<div class="option">'+
					   '<div class="row">'+
						   '<div class="col-md-6">'+
							   '<h4 class="no'+n+'">'+n+'.Video '+n+'</h4>'+
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
				   '<div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Image</label>'+
					'<div class="col-sm-10">'+
						'<input type="file" class="form-control" name="image[]" id="image'+n+'">'+
						'<input type="hidden" name="image_text[]" id="image_text'+n+'" value="" class="form-control">'+
					'</div>'+
				   '</div>'+
				  ' <div class="form-group">'+
					'<label class="col-sm-2 control-label">Pilih Video</label>'+
					'<div class="col-sm-10">'+
						'<input type="file" class="form-control" name="video[]" id="video'+n+'">'+
						'<input type="hidden" name="video_text[]" id="video_text'+n+'" value="" class="form-control">'+
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
			   var get=$('.get'+button_id).val();

				  // 	  alert(button_id);
			   $(".count-all").each(function(){
				  var idrow=$(this).val();
				  if(idrow > get){
					  var hitung = parseInt(idrow)-1;
					  var rowname= $(this).attr('rowname');
					  $('.no'+rowname).html(hitung+'.Video '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
