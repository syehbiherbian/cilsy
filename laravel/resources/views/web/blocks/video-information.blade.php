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
            
          </div>
        </div><!--./ Tabs -->

      </div>
    </div>
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
                <strong>Rizal Rahman</strong>
                <p class="help-block">Praktisi</p>
                <a href="#" class="btn btn-warning mb-15">Lihat Profile</a>
                <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="#">Lebih Banyak</a>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Panel -->
      </div>
    </div>
  </div>
</section><!-- ./VIDEO INFORMATION -->

@push('js')


@endpush
