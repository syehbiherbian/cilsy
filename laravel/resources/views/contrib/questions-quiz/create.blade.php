@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Totorial</a></li>
			  <li><a href="{{ url('contributor/lessons/'.$quiz->lessons_id.'/edit') }}">Kelola Quiz</a></li>
				<li><a href="{{ url('ontributor/lessons/quiz/'.$quiz->id.'/edit') }}">Kelola Soal</a></li>
        <li>Buat Soal</li>
		</ul>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">

	    <form class="form-horizontal form-contributor">
				<div class="form-title">
					<h3>Tutorial Linux Fundamental dengan ubuntu 14.04 LTS</h3>
			 	</div>
				<div class="item">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4>1.Soal 1</h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
								  <button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban A</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key_a[]" id="question_key_a0">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="answer_a[]" id="answer_a0" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban B</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key_b[]" id="question_key_b0">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="answer_b[]" id="answer_b0" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban C</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key_c" id=question_key_c0>
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="answer_c[]" id="answer_c0" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban D</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox" name="question_key_d[]" id="question_key_d0">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="answer_d[]" id="answer_d0" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


				</div>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/tambah.png') }}" alt="" width="15"> tambah soal</button>
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
