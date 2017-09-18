@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <a href="{{ url('contributor/lessons/create')}}" class="btn btn-info pull-right">Buat Tutorial</a>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li>Kelola Tutorial</li>
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

        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
          <li class="active"><a href="{{ url('contributor/account/informasi') }}">Informasi Akun</a></li>
          <li class=""><a href="{{ url('contributor/account/halaman') }}">Halaman Kontributor</a></li>
        </ul>

        <div class="tab-content" >
        <div class="col-md-12" >
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password Lama</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="old_password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password Baru</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="new_password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Konfirmasi Password Baru</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="new_confirm">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 text-right">
            <button type="submit" class="btn btn-info">Save</button>
          </div>
        </div>
      </form>
        </div>
        
          </div>
        </div>
    </div>
  </div>
</div>
@endsection()
