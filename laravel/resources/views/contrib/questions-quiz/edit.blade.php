@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Totorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$quiz->lesson_id.'/view') }}">Kelola Quiz</a></li>
				<li><a href="{{ url('contributor/lessons/quiz/'.$quiz->id.'/view') }}">Kelola Soal</a></li>
        <li>Edit Soal</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
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
		<div class="box-white">
				<form class="form-horizontal form-contributor" action="{{url('contributor/lessons/'.$quiz->id.'/update_questions')}}"  method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="method" value="PUT">
				<div class="form-title">
					<h3>{{$quiz->title}}</h3>
			 	</div>

        <?php $i =0; ?>

		<input type="hidden" name="count0" value="0" class="count-all" rowname="0">

        @foreach($question as $value)
        <?php $n= $i + 1; ?>
        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
					<input type="hidden" name="count<?php echo $i; ?>" value="<?php echo $i; ?>" class="count-all get<?php echo $i; ?>" rowname="<?php echo $i; ?>">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4 class="no<?php echo $i; ?>"><?php echo $i; ?>.Soal <?php echo $i; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
								  <button type="button" class="btn btn-default btn-outline  btn_remove  hapus<?php echo $i; ?>" id="{{$i}}" ><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question[]" id="question<?php echo $a;?>" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?" value="{{$value->question}}" required>
							<input type="hidden" name="questionid[]" value="{{$a}}" id="questionid<?php echo $a;?>">
						</div>
					</div>
					<hr>
          @foreach($answer as $answers)
            @if($value->id==$answers->question_id and $answers->type==0)
					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban A</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key<?php echo $a;?>_0" <?php if($answers->answer_key==1){echo "checked";} ?>>
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" required name="answer<?php echo $a;?>[]" id="answer_a<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>
          @endif
          @endforeach

          @foreach($answer as $answers)
            @if($value->id==$answers->question_id and $answers->type==1)
					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban B</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key<?php echo $a;?>_1" <?php if($answers->answer_key==1){echo "checked";} ?>>
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" required name="answer<?php echo $a;?>[]" id="answer_b<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>
          @endif
          @endforeach

          @foreach($answer as $answers)
            @if($value->id==$answers->question_id and $answers->type==2)
					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban C</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key<?php echo $a;?>_2" <?php if($answers->answer_key==1){echo "checked";} ?>>
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" required name="answer<?php echo $a;?>[]" id="answer_c<?php echo $a;?>" placeholder="Tulis Jawaban disini"value="{{$answers->answer}}">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>
          @endif
          @endforeach

          @foreach($answer as $answers)
            @if($value->id==$answers->question_id and $answers->type==3)
					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban D</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key<?php echo $a;?>_3" <?php if($answers->answer_key==1){echo "checked";} ?>>
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" required name="answer<?php echo $a;?>[]" id="answer_d<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>
				</div>
        @endif
        @endforeach

        @endforeach

				<div class="row" id="dynamic_field">
				</div>
	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" id="addanswer"  class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/tambah.png') }}" alt="" width="15"> Tambah Soal</button>
					</div>
	        <div class="col-sm-12 text-right">
	          <a class="btn btn-danger">Batal</a>
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
		 var count="{{$count_question}}";
 	    	var i= parseInt(count);
          $('#addanswer').click(function(){
							//d=i + 2;
				  var no= $('.count-all').last().val();
	 			   n=parseInt(no) + 1;

              j=++i;
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+n+'">'+
							 '<div class="item">'+
							  '<input type="hidden" name="count'+n+'" value="'+n+'" class="count-all get'+n+'" rowname="'+n+'">'+
							 '<div class="option">'+
							 '<div class="row">'+
							 '<div class="col-md-6">'+
							  '<h4 class="no'+n+'">'+n+'.Soal '+n+'</h4>'+
							 '</div>'+
							 '<div class="col-md-6 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline btn_remove" id="'+n+'"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Judul</label>'+
							 '<div class="col-sm-10">'+
							 '<input type="text" required class="form-control" name="question[]" id="question'+ j +'" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?">'+
							 '<input type="hidden" name="questionid[]" value="'+ j +'" id="questionid'+ j +'">'+
							 '</div>'+
							 '</div>'+
							 '<hr>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban A</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_0">'+
							 '</label>'+
							 '</div>'+
							 '</div>'+

							 '<div class="col-sm-7">'+
							  '<input type="text" required  class="form-control" name="answer'+ j +'[]" id="answer_a'+ j +'" placeholder="Tulis Jawaban disini">'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban B</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_1">'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_b'+ j +'" placeholder="Tulis Jawaban disini">'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban C</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_2" >'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_c'+ j +'" placeholder="Tulis Jawaban disini">'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Jawaban D</label>'+
							 '<div class="col-sm-1">'+
							 '<div class="checkbox">'+
							 '<label>'+
							 '<input type="checkbox" name="question_key'+ j +'_3">'+
							 '</label>'+
							 '</div>'+
							 '</div>'+
							 '<div class="col-sm-7">'+
							 '<input type="text" required class="form-control" name="answer'+ j +'[]" id="answer_d'+ j +'" placeholder="Tulis Jawaban disini">'+
							 '</div>'+
							 '<div class="col-sm-2 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
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
					  $('.no'+rowname).html(hitung+'.Soal '+hitung);
					  $(this).val(hitung);
				  }
			  });
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
