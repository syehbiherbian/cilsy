@extends('web.app')
@section('title','Reward | Change')
@section('content')
<div id="table-section">
    <div class="container" style="margin-top:20px;">
        <div class="row">
          <div class="col-md-12">
        		<div class="box-white">
        	    <form class="form-horizontal form-contributor" action="" method="post">
        				{{ csrf_field() }}
        				<div class="submit">
        					<div class="text-center">
        						<img src="{{ asset('template/kontributor/img/icon/question.png') }}" alt="" width="150">
        						<h4><strong>Apakah anda yakin menukar point dengan reward ini ?</strong></h4>
        					</div>
        					<div class="text" style="text-align:center">
        						<p>Apabila reward ini sudah disubmit, points anda akan dipotong {{$reward->poin}} pts untuk mendapatakan reward ini.</p>
        						<p><i>Catatan: Point yand ditukar tidak dapat dikembalikan lagi.</i></p>
        					</div>
        				</div>

        	      <div class="form-group">

        	        <div class="col-sm-12 text-center">
        	          <a href="{{ url('member/rewards')}}" class="btn btn-danger">Batal</a>
        						<button type="submit" class="btn btn-info">Submit</button>
        	        </div>
        	      </div>
        	    </form>
        		</div>
          </div>
        </div>
    </div>
</div>
@endsection()
