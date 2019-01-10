@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        {{--  <a href="{{ url('contributor/lessons/create')}}" class="btn btn-info pull-right">Buat Tutorial</a>  --}}
        <button class="btn btn-info pull-right pull-right" data-toggle="modal" data-target="#modalStep">Buat Tutorial</button>
        <ul class="breadcrumb">
        <li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li>Kelola Tutorial</li>
        </ul>
    </div>
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


        <div class="tab-content">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Tutorial</th>
                  <th>Kategori</th>
                  <th>price</th>
                  <th>Jumlah murid bulan ini</th>
                  <th>status</th>
                  <th>Lebih lanjut</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($data) == 0): ?>
                  <tr>
                    <td colspan="8">Tidak Ada data</td>
                  </tr>
                <?php else: ?>
                <?php $i = 1; ?>
                <?php foreach ($data as $key => $row): ?>
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $row->title }}</td>
                  <td>{{ $row->category_title }}</td>
                  <td>{{ $row->price }}</td>
                  <td>
                      <?php $student=0; ?>
                      @foreach ($students as $details)
                        @if($details->lesson_id==$row->id)
                         <?php $student=$student +1 ; ?>
                        @elseif($details->lesson_id !==$row->id)
                        @endif
                      @endforeach

                     {{$student}}
                  </td>
                  <td>
                   <?php if ($row->status == 0): ?>
                    <div class="label label-warning">Draft</div>
                  <?php elseif($row->status == 1): ?>
                      <div class="label label-success">Publish</div>
                  <?php elseif($row->status == 2): ?>
                      <div class="label label-info">Proses</div>
                  <?php elseif($row->status == 3): ?>
                      <div class="label label-warning">Revisi</div>
                  <?php endif; ?>
                  </td>
                  <td><a href="{{ url('contributor/lessons/'.$row->id.'/view')}}" class="btn btn-warning">View</a>
                  </td>
                  <td>
                  <form id="{{ $row->id }}" action="{{ url('contributor/lessons/'.$row->id.'/submit')}}" method="post">
                  				{{ csrf_field() }}
                  <button type="button"  title="Publish" data-toggle="tooltip" class="btn btn-success pull-right" data-toggle="tooltip" onclick="checkpublish({{$row->id}})">publish</button>
                  </form>
                  </td>
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
<!-- Modal -->
    <div class="modal fade multi-step" id="modalStep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
              <h4>Pilih Kelas yang akan dibuat</h4>
            </div>
            <form role="form" action="">
              <div class="modal-body">
                <!-- Step 1 -->
                <div class="row setup-content" id="step-1">
                  <div class="col-sm-6 col-xs-12">
                    <div class="card mt-4">
                      <i class="fa fa-tv"></i>
                      <p class="mt-3">
                        Kelas dengan biaya rendah tidak terlalu kompleks namun tetap bisa mendapatkan minat yang kuat.
                      </p>
                      <a href="{{ url('contributor/lessons/create')}}" class="btn btn-outline-modal nextBtn" type="button">Pilih</a>
                    </div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                      <div class="card mt-4">
                        <i class="fa fa-tv"></i>
                        <p class="mt-3">
                          Buat kelas online lengkap menggunakan kurikulum yang terstruktur dan komprehensif.
                          <br><br>
                        </p>
                        <button class="btn btn-outline-modal nextBtn" type="button">Pilih</button>                      
                      </div>
                  </div>
                </div>

                <!-- Step 2 -->
                <div class="row setup-content" id="step-2">
                  <div class="col-xs-12">
                      <div class="form-group">
                          <input type="text" class="form-control" name="judul" id="judul" required placeholder="Judul Kelas">
                      </div>
                      Jangan khawatir jika anda belum bisa memikirkan judul yang bagus sekarang.
                      Anda bisa mengubahnya nanti.
                  </div>
                </div>

                <!-- Step 3 -->
                <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <select class="form-control" name="kategori" id="kategori">
                        <option value="-">Pilih kategori</option>
                      </select>
                    </div>
                    Jangan khawatir Anda bisa mengubahnya nanti.
                  </div>
                </div>

                <div class="requestwizard mt-5">
                  <div class="requestwizard-row setup-panel">
                    <div class="requestwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fa fa-circle"></i></a>
                        <p>Step 1</p>
                    </div>
                    <div class="requestwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-circle"></i></a>
                        <p>Step 2</p>
                    </div>
                    <div class="requestwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-circle"></i></a>
                        <p>Step 3</p>
                    </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-green pull-left" type="button"  id="prevBtn">Sebelumnya</button>
                  <button class="btn btn-green pull-right" type="button" id="nextBtn">Selanjutnya</button>
                  <input class="btn btn-green pull-right" type="submit" id="classBtn" value="Buat Kelas">
              </div>
          </form>
        </div>
      </div>
    </div>
<script>
 function checkpublish(id){

   swal({
     title: "Apakah kamu sudah selesai?",
     text: "Lessons ini akan muncul di halaman cilsy.id. Perhatikan kembali data yang anda akan publish!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Publish Tutorial!",
     cancelButtonText: "Tidak, Batalkan!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {

       $('#'+id).submit();

       swal("Publish!", "Data Anda telah dipublish.", "success");
     } else {
       swal("Cancelled", "Silahkan lanjutkan kembali :)", "error");
     }
     });
 }
 </script>
@endsection()
