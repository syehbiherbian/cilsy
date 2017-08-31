@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Totorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$quiz->lessons_id.'/view') }}">Kelola Quiz</a></li>
				<li><a href="{{ url('contributor/lessons/quiz/'.$quiz->id.'/view') }}">Kelola Soal</a></li>
        <li>Edit Soal</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		@if($errors->all())
		 <div class="alert alert-danger">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				 <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
				 @foreach($errors->all() as $error)
				 <?php echo $error."</br>";?>
				 @endforeach
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
        @foreach($question as $value)
        <?php $n= $i + 1; ?>
        <?php $a= $i++;?>
				<div class="item" id="row{{$i}}">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4><?php echo $i; ?>.Soal <?php echo $i; ?></h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
								  <button type="button" class="btn btn-default btn-outline  btn_remove" id="{{$i}}" ><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question[]" id="question<?php echo $a;?>" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?" value="{{$value->question}}">
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
							<input type="text" class="form-control" name="answer<?php echo $a;?>[]" id="answer_a<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
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
							<input type="text" class="form-control" name="answer<?php echo $a;?>[]" id="answer_b<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
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
							<input type="text" class="form-control" name="answer<?php echo $a;?>[]" id="answer_c<?php echo $a;?>" placeholder="Tulis Jawaban disini"value="{{$answers->answer}}">
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
							<input type="text" class="form-control" name="answer<?php echo $a;?>[]" id="answer_d<?php echo $a;?>" placeholder="Tulis Jawaban disini" value="{{$answers->answer}}">
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

				<!-- <div class="row" id="dynamic_field">
				</div> -->
	      <div class="form-group">
					<!-- <div class="col-sm-2">
						<button type="button" name="button" id="addanswer"  class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/tambah.png') }}" alt="" width="15"> tambah soal</button>
					</div> -->
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
          var i=0;
          $('#addanswer').click(function(){
							n=i + 2;

              j=++i;
              //<td width="40%"><input type="text" class="form-control" name="varianname[]" id="varname'+ j +'"></td>
              // <td><input type="hidden" class="form-control" name="qty[]" id="varqty'+ j +'"></td>
               $('#dynamic_field').append('<div class="col-sm-12"style="margin-top:20px;margin-bottom:20px;" id="row'+i+'">'+
							 '<div class="item">'+
							 '<div class="option">'+
							 '<div class="row">'+
							 '<div class="col-md-6">'+
							 '<h4>'+n+'.Soal '+n+'</h4>'+
							 '</div>'+
							 '<div class="col-md-6 text-right">'+
							 '<div class="btn-group">'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>'+
							 '<button type="button" class="btn btn-default btn-outline btn_remove" id="'+i+'"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+
							 '</div>'+

							 '<div class="form-group">'+
							 '<label class="col-sm-2 control-label">Judul</label>'+
							 '<div class="col-sm-10">'+
							 '<input type="text" class="form-control" name="question[]" id="question'+ j +'" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?">'+
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
							  '<input type="text" class="form-control" name="answer'+ j +'[]" id="answer_a'+ j +'" placeholder="Tulis Jawaban disini">'+
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
							 '<input type="text" class="form-control" name="answer'+ j +'[]" id="answer_b'+ j +'" placeholder="Tulis Jawaban disini">'+
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
							 '<input type="text" class="form-control" name="answer'+ j +'[]" id="answer_c'+ j +'" placeholder="Tulis Jawaban disini">'+
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
							 '<input type="text" class="form-control" name="answer'+ j +'[]" id="answer_d'+ j +'" placeholder="Tulis Jawaban disini">'+
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
               $('#row'+button_id+'').remove();
          });

     });
</script>

@endsection()
