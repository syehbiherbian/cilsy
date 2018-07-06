@push('css')


@endpush

<!-- BEGIN CONTRIBUTORS PROFILE BODY-->
<section class="contributor-profile-body mb-25">
  <div class="container">
    <div class="row">
      <div class="col-md-3 pt-25 ">
        <?php if ($contributors->avatar): ?>
          <img src="{{ asset($contributors->avatar) }}" alt="" class="img-responsive img-center">
        <?php else: ?>
          <img src="{{ asset('template/kontributor/img/icon/avatar.png') }}" alt="" class="img-responsive img-center">
        <?php endif; ?>
        <div class="text-center mt-15">
          <div class="btn-group">
            <button type="button" class="btn btn-primary">{{ count($contributors_total_lessons) }} Tutorial</button>
          </div>
        </div>
      </div>
      
      <div class="col-md-9 pt-25 ">
          <div class="about-text">
            <?= $contributors->about ?>
          </div>
          <div class="row lessons-grid">
            <?php
              $i = 1;
              foreach ($contributors_lessons as $key => $lesson): ?>
                  <?php if ($i <= 12) {?>
                    <div class="col-md-4">
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
            <div class="row">
          <div class="col-md-12 text-center">
              {{ $contributors_lessons->links() }}
          </div>
      </div>
          </div>
      </div>
    </div>
  </div>
</section><!-- ./END CONTRIBUTORS PROFILE BODY -->

@push('js')



@endpush