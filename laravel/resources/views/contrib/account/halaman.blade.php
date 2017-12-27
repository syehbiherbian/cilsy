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
                 <h4> <i class="icon fa fa-check"></i> Alert!</h4>
                 {{ Session::get('success') }}
             </div>
         @endif

        @if(Session::has('success-delete'))
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
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
          <li class=""><a href="{{ url('contributor/account/informasi') }}">Informasi Akun</a></li>
          <li class="active"><a href="{{ url('contributor/account/profile') }}">Halaman Kontributor</a></li>
        </ul>

        <div class="tab-content" >
        <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">   
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->first_name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->last_name }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pekerjaan :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->pekerjaan }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tempat Lahir:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->tempat_lahir }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Lahir:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="{{ $contrib->tanggal_lahir }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Bio:</label>
            <div class="col-md-8">
              <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 pull-right">
              <input type="button" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
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
