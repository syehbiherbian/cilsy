@push('css')


@endpush
<!-- BEGIN VIDEO INFORMATION -->
<section class="video-information mb-50">
  <div class="container">
    <div class="row video mb-25">
      <div class="col-md-12">
        <!-- Tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#tab1">Deskripsi Tutorial</a></li>
          <li><a data-toggle="tab" href="#tab2">Daftar Materi</a></li>
          <li><a data-toggle="tab" href="#tab3">Berkas Praktek</a></li>
          <li><a data-toggle="tab" href="#tab4">Komentar</a></li>
        </ul>

        <div class="tab-content">
          <div id="tab1" class="tab-pane fade in active">
            <?= $lessons->description ?></p>
          </div>
          <div id="tab2" class="tab-pane fade">
            <ul class="materi_list">
              <?php foreach ($main_videos as $row) {?>
              <li>
                <strong><?= $row->title ?></strong>
                <?php if ($services) {?>
                <span class="pull-right"><a href="{{ $row->video }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download Video</a></span>
                <?php }?>
                <p><?=nl2br($row->description);?></p>
              </li>
              <?php }?>
            </ul>
          </div>
          <div id="tab3" class="tab-pane fade">
            <?php if ($services) {?>
                @foreach($file as $key => $files)
                    <a href="{{ $files->source }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download {{ $files->title}}</a><br><br>
                @endforeach
            <?php } else {?>
                <button type="button" name="button"  class="btn btn-info btn-md disabled"><i class="fa fa-download"></i> Download </button>
            <?php }?>
          </div>
          <div id="tab4" class="tab-pane fade">

            <?php if (empty(Session::get('memberID'))) { ?>
              <div class="text-center mb-25">
                Silahkan <a href="{{ url('member/signin') }}" class="btn btn-primary"> Masuk</a> untuk memberikan komentar
              </div>
          	<?php	}else { ?>

            <!-- Comment Form -->
            <div class="comments-form mb-25">
              <!-- <form id="form-comment" class="mb-25">
                {{-- csrf_field() --}}
                <input type="hidden" name="lesson_id" value="{{-- $lessons->id --}}">
                <input type="hidden" name="parent_id" value="0"> -->
                <div class="form-group">
                  <label>Komentar</label>
                  <textarea rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onClick="doComment({{ $lessons->id }},0)" >Kirim</button>
              <!-- </form><!--./ Comment Form -->
            </div>

            <?php } ?>

            <!-- Comments Lists -->
            <div id="comments-lists">
              <p>Memuat Komentar . . .</p>
            </div>
            <!--./ Comments Lists -->



          </div>
        </div><!--./ Tabs -->

      </div>
    </div>
    <?php if ($contributors): ?>

    <div class="row contributor mb-25">
      <div class="col-md-12">
        <!-- Panel -->
        <div class="panel panel-default">
          <div class="panel-heading">Kontributor</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3">
                <?php if ($contributors->avatar): ?>
                  <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center">
                <?php else: ?>
                  <img src="{{ asset('template/kontributor/img/icon/avatar.png') }}" alt="" class="img-responsive img-center">
                <?php endif; ?>
                <div class="text-center mt-15">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">{{ count($contributors_total_lessons) }} Tutorial</button>
                    <button type="button" class="btn btn-primary">{{ $contributors_total_view }} View</button>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <strong>{{ $contributors->username }}</strong>
                <p class="help-block">{{ $contributors->job }}</p>
                <a href="#" class="btn btn-warning mb-15">Lihat Profile</a>
                <p ><?= $contributors->about ?></p>
                <a href="#">Lebih Banyak</a>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Panel -->
      </div>
    </div>

    <?php endif; ?>
  </div>
</section><!-- ./VIDEO INFORMATION -->

@push('js')
<script type="text/javascript">
$(document).on('ready',function () {
  getComments();
});
  //
  // $('#form-comment').on('submit',function(e) {
  //   e.preventDefault();
  //
  //   var body = $('[name=body]').val();
  //   if (body == '') {
  //     alert('Harap Isi Komentar !')
  //   }else {
  //       $.ajax({
  //           type    :'POST',
  //           url     :'{{ url("lessons/coments/doComment") }}',
  //           dataType: 'json',
  //           data    : $(this).serialize(),
  //           success:function(data){
  //             if (data.success == false) {
  //                window.location.href = '{{ url("member/signin") }}';
  //             }else if (data.success == true) {
  //               document.getElementById('form-comment').reset();
  //               getComments();
  //             }
  //           }
  //       });
  //   }
  //
  // });

  function getComments() {
    $.ajax({
        type    :'GET',
        url     :'{{ url("lessons/coments/getComments/".$lessons->id) }}',
        success:function(data){
          if (data == '') {
            $('#comments-lists').html('Tidak Ada Komentar');
          }else {
            $('#comments-lists').html(data);
          }
        }
    });
  }

  function doComment(lesson_id, parent_id) {

    var body = $('#textbody'+parent_id).val();
    if (body == '') {
      alert('Harap Isi Komentar !')
    }else {


      var postData =
                  {
                      "_token":"{{ csrf_token() }}",
                      "lesson_id": lesson_id,
                      "parent_id": parent_id,
                      "body": body
                  }

      $.ajax({
          type    :'POST',
          url     :'{{ url("lessons/coments/doComment") }}',
          dataType: 'json',
          data    : postData,
          success:function(data){
            if (data.success == false) {
               window.location.href = '{{ url("member/signin") }}';
            }else if (data.success == true) {
              $('#textbody'+parent_id).val('');
              getComments();
            }
          }
      });
    }
  }
</script>

@endpush
