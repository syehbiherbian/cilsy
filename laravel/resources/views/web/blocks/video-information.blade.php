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
            <!-- Comment Form -->
            <form id="form-comment">
              {{ csrf_field() }}
              <input type="hidden" name="lesson_id" value="{{ $lessons->id }}">
              <input type="hidden" name="parent" value="0">
              <div class="form-group">
                <label>Komentar</label>
                <textarea name="name" rows="8" cols="80" class="form-control" name="comment"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Kirim</button>
            </form><!--./ Comment Form -->

            <!-- Comments Lists -->
            <div id="comments-lists"></div>
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
                <img src="{{ asset('template/kontributor/img/icon/avatar.png') }}" alt="" class="img-responsive img-center">
                <div class="text-center mt-15">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">10 Tutorial</button>
                    <button type="button" class="btn btn-primary">500 View</button>
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


  $('#form-comment').on('submit',function(e) {
    e.preventDefault();


    $.ajax({
        type    :'POST',
        url     :'{{ url("lessons/coments/doComment") }}',
        data    : $(this).serialize(),

        success:function(data){

          if (data.success == false) {
             window.location.href = '{{ url("member/signin") }}';
          }else {
            getComments();
          }

        }
    });

  });

  function getComments() {

    // var postData =
    //             {
    //                 "_token":"{{ csrf_token() }}",
    //                 "lessons_id": "{{ $lessons->id }}"
    //             }

    $.ajax({
        type    :'GET',
        url     :'{{ url("lessons/coments/getComments/".$lessons->id) }}',
        // dataType: json,
        // data    : postData,
        success:function(data){

          if (data.success == false) {
             window.location.href = '{{ url("member/signin") }}';
          }else {

            // alert(data);
            $('#comments-lists').html(data.html);


          }

        }
    });
  }
</script>

@endpush
