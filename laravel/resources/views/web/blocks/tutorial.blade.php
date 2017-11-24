@push('css')


@endpush

<!-- BEGIN TUTORIAL -->
<section class="tutorial">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <!-- New Tutorial -->
        <div class="tutorial-row">
          <div class="row">

            <div class="col-md-3">
              <div class="title-area pb-25 hidden">
                <div class="inner ">
                  <h2 class="mb-25">Tutorial baru</h2>
                  <p>Belajar dengan dukungan Trainer Profesional</p>
                </div>
              </div>
            </div>
            <?php
              $i = 1;
              foreach ($newlessons as $key => $lesson): ?>
                  <?php if ($i <= 3) {?>
                    <div class="col-md-3">
                      <a href="{{ url('lessons/'.$lesson->slug)}}">
                        <div class="card">
                          <?php if (!empty($lesson->image)) {?>
                            <img src="{{ asset($lesson->image) }}" alt="" class="img-responsive">
                          <?php } else {?>
                            <img src="{{ asset('template/web/img/no-image-available.png') }}" alt="" class="img-responsive">
                          <?php }?>
                          <div class="caption">
                            <p>{{ $lesson->title }}</p>
                          </div>
                          <div class="footer">
                            <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                          </div>
                        </div>
                      </a>
                    </div>
                <?php } ?>
                <?php $i++;?>
            <?php endforeach; ?>

          </div>
          <div class="row">
            <div class="col-md-12">
              <a href="{{ url('lessons/browse/all') }}" class="btn btn-default btn-more pull-right">Selengkapnya <i class="ion-arrow-right-c"></i></a>
            </div>
          </div>
        </div>
        <!-- /.New Tutorial -->

        <!-- List Tutorial -->
        <?php foreach ($categories as $key => $category): ?>
        <div class="tutorial-row">
          <div class="row">
            <div class="col-md-3">
              <div class="title-area pb-25 hidden">
                <div class="inner">
                  <h2 class="mb-25">{{ $category->title }}</h2>
                  <?= $category->description;?>
                </div>
              </div>
            </div>
            <?php
              $i = 1;
              foreach ($lessons as $key => $lesson): ?>
                <?php if ($category->id == $lesson->category_id) {?>
                  <?php if ($i <= 3) {?>
                    <div class="col-md-3">
                      <a href="{{ url('lessons/'.$lesson->slug)}}">
                        <div class="card">
                          <?php if (!empty($lesson->image)) {?>
                            <img src="{{ asset($lesson->image) }}" alt="" class="img-responsive">
                          <?php } else {?>
                            <img src="{{ asset('template/web/img/no-image-available.png') }}" alt="" class="img-responsive">
                          <?php }?>
                          <div class="caption">
                            <p>{{ $lesson->title }}</p>
                          </div>
                          <div class="footer">
                            <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                          </div>
                        </div>
                      </a>
                    </div>
                <?php } ?>
                <?php $i++;?>
              <?php } ?>

            <?php endforeach; ?>

          </div>
          <div class="row">
            <div class="col-md-12">
              <a href="{{ url('lessons/category/'.$category->title)}}" class="btn btn-default btn-more pull-right">Selengkapnya <i class="ion-arrow-right-c"></i></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <!-- /.List Tutorial -->


      </div>
    </div>
  </div>
</section><!-- ./END TUTORIAL -->

@push('js')
<script type="text/javascript">
  $(document).on('ready',function () {

    var wh = $(window).width();
    if (wh >768) {
      var h = $('.tutorial .tutorial-row').height() - 50;
      $('.tutorial .tutorial-row .title-area').height(h);

    }

    $('.tutorial .tutorial-row .title-area').removeClass('hidden');

  });
</script>



@endpush
