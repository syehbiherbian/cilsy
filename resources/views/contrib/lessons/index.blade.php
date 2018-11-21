@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        <a href="{{ url('contributor/lessons/create')}}" class="btn btn-info pull-right">Buat Tutorial</a>
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
