@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <a href="{{ url('contributor/lessons/create')}}" class="btn btn-danger pull-right">Hapus Tutorial</a>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor') }}">Dashboard</a></li>
        <li>Kelola Tutorial</li>
		</ul>
</div>
@endsection
@section('content')

<!-- BEGIN lESSON -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">

      <div class="box-content">
        <div class="row">
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

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END lESSON -->

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
<!-- BEGIN QUIZ -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Kuis</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
              <a href="#" class="btn btn-danger">Edit</a>
              <a href="#" class="btn btn-info">Tambah Kuis</a>
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
                <td>Kuis Tahap 1</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END QUIZ -->
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
@endsection()
