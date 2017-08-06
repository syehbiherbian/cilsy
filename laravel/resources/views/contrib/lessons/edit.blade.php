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

<!-- BEGIN ALERT -->
<div class="row">
  <div class="col-md-12">
    @include('contrib.include.alert')
  </div>
</div>
<!-- END ALERT -->

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
                <h4>{{ $lessons->title }}</h4>
              </div>
              <div class="col-md-4 text-right">
                <?php if ($lessons->status == 0){ ?>
                  <div class="label label-warning">Belum di verifikasi</div>
                <?php }else if ($lessons->status == 1){ ?>
                  <div class="label label-success">Sudah di Publish</div>
                <?php }else if ($lessons->status == 2){ ?>
                  <div class="label label-info">Sedang di Proses</div>
                <?php }else if ($lessons->status == 3){ ?>
                  <div class="label label-primary">Revisi</div>
                <?php } ?>
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
                <p>: {{ $lessons->category_title }}</p>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Deskripsi Tutorial</p>
              </div>
              <div class="col-md-9">
                <p>: {{ $lessons->description }}</p>
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
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/videos/edit') }}" class="btn btn-danger">Edit</a>
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/videos/create') }}" class="btn btn-info">Tambah Video</a>
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
              <?php if (count($videos) == 0): ?>
                <tr>
                  <td colspan="3">Tidak ada data</td>
                </tr>
              <?php else: ?>
                <?php $i = 1; ?>
                <?php foreach ($videos as $key => $row): ?>
                <tr>
                  <td width="25">{{ $i }}</td>
                  <td>{{ $row->title }}</td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
              <?php endif; ?>
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
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/quiz/edit') }}" class="btn btn-danger">Edit</a>
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/quiz/create') }}" class="btn btn-info">Tambah Kuis</a>
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
              <?php if (count($videos) == 0): ?>
                <tr>
                  <td colspan="3">Tidak ada data</td>
                </tr>
              <?php else: ?>

                <?php foreach ($quiz as $key => $row): ?>
                <tr>
                  <td width="25">{{ $i }}</td>
                  <td>{{ $row->title }}</td>
                </tr>
                <?php endforeach; ?>

              <?php endif; ?>
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
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/files/edit') }}" class="btn btn-danger">Edit</a>
              <a href="{{ url('contributor/lessons/'.$lessons->id.'/files/create') }}" class="btn btn-info">Tambah Lampiran</a>
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
              <?php if (count($files) == 0): ?>
                <tr>
                  <td colspan="3">Tidak ada data</td>
                </tr>
              <?php else: ?>
                <?php foreach ($files as $key => $row): ?>
                <tr>
                  <td width="25">{{ $i }}</td>
                  <td>{{ $row->title }}</td>
                </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END ATTCHMENT -->
@endsection()
