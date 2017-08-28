@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
<<<<<<< HEAD
    <a href="{{ url('contributor/lessons/quiz/'.$row->id.'/delete')}}" class="btn btn-danger pull-right">Hapus Quiz</a>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Totorial</a></li>
        <li><a href="{{ url('contributor/lessons/'.$row->lesson_id.'/edit') }}">Kelola Quiz</a></li>
        <li>Edit Quiz</li>
=======
    <a href="{{ url('contributor/lessons/create')}}" class="btn btn-danger pull-right">Hapus Tutorial</a>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li>Kelola Tutorial</li>
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
		</ul>
</div>
@endsection
@section('content')

<<<<<<< HEAD
@if($errors->all())
 <div class="alert alert-danger">
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

=======
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
<!-- BEGIN lESSON -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">

      <div class="box-content">
        <div class="row">
<<<<<<< HEAD
          <div class="col-md-12">
            <div class="form-title">
              <h3>{{$lessons->title}}</h3>
            </div>
            <form class="form-horizontal" action="{{url('contributor/lessons/'.$row->id.'/update_quiz')}}"  method="POST">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="method" value="PUT">
              <div class="form-group">
                <label class="col-sm-2 control-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name= "title" value="{{$row->title}}" placeholder="Contoh: Kuis tahap pertama">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Muncul Setelah Video</label>
                <div class="col-sm-10">
                  <select class="form-control" name="video">
                    <option value="">Select Video</option>
                      @foreach($video as $value)
                      <option value="{{$value->id}}"<?php if($value->id==$row->video_id){echo 'selected="selected"';}?>>{{$value->title}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Deskripsi Kuis</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="desc" rows="8" cols="80" placeholder="Contoh: Ini adalah kuis tahap awal"><?php echo $row->description; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                  <a class="btn btn-danger">Batal</a>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
            </form>
=======
          <div class="col-md-3">
            <img src="" class="img-responsive" alt="Gambar Tutorial">
          </div>
          <div class="col-md-9">
            <!-- Title -->
            <div class="row">
              <div class="col-md-8">
                <h4>Tutorial Linux Fundamental dengan ubuntu 14.04 LTS</h4>
              </div>
              <div class="col-md-4 text-right">
                  <div class="label label-warning">Belum Di verifikasi</div>
                  <a href="#" class="btn btn-danger">Edit</a>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Kategori</p>
              </div>
              <div class="col-md-9">
                <p>: Linux</p>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Deskripsi Tutorial</p>
              </div>
              <div class="col-md-9">
                <p>: Active Directory Domain Controller merupakan salah satu keunggulan server windows.</p>
              </div>
            </div>
            <!-- End Title -->

>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END lESSON -->

<<<<<<< HEAD

=======
<!-- BEGIN VIDEO -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Video</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
              <a href="#" class="btn btn-danger">Edit</a>
              <a href="#" class="btn btn-info">Tambah Video</a>
            </div>
          </div>
        </div>
      </div>
      <div class="box-content">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=1; $i < 6 ; $i++) { ?>
              <tr>
                <td width="25">{{ $i }}</td>
                <td>Pengenalan dan Instalasi ubuntu server</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END VIDEO -->
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
<!-- BEGIN QUIZ -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
<<<<<<< HEAD
              <h4>Daftar Soal</h4>
=======
              <h4>Daftar Kuis</h4>
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
<<<<<<< HEAD
              <a href="{{url('contributor/lessons/quiz/'.$row->id.'/edit/questions')}}" class="btn btn-danger">Edit</a>
              <a href="{{url('contributor/lessons/quiz/'.$row->id.'/create/questions')}}" class="btn btn-info">Tambah Soal</a>
=======
              <a href="#" class="btn btn-danger">Edit</a>
              <a href="#" class="btn btn-info">Tambah Kuis</a>
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
            </div>
          </div>
        </div>
      </div>
      <div class="box-content">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
              </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
              <?php $i=1;?>
              @foreach($question as $value)
              <tr>
                <td width="25">{{ $i }}</td>
                <td>{{$value->question}}</td>
              </tr>
              <?php $i++;?>
              @endforeach
=======
              <?php for ($i=1; $i < 6 ; $i++) { ?>
              <tr>
                <td width="25">{{ $i }}</td>
                <td>Kuis Tahap 1</td>
              </tr>
              <?php } ?>
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END QUIZ -->
<<<<<<< HEAD

=======
<!-- BEGIN ATTCHMENT -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Lampiran</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
              <a href="#" class="btn btn-danger">Edit</a>
              <a href="#" class="btn btn-info">Tambah Lampiran</a>
            </div>
          </div>
        </div>
      </div>
      <div class="box-content">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=1; $i < 6 ; $i++) { ?>
              <tr>
                <td width="25">{{ $i }}</td>
                <td>Installer Ubuntu 14.04 LTS</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END ATTCHMENT -->
>>>>>>> b90e1163dd00a4c271974147e8830b63634025b9
@endsection()
