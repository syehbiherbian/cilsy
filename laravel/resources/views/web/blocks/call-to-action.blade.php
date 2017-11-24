@push('css')


@endpush

<!-- BEGIN CALL TO ACTION -->
<section class="call-to-action mb-50">
  <div class="container">
    <div class="row ">
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner">
            <h2>Akses ke semua tutorial sekarang!</h2>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner text-center">
            <?php if (Session::get('memberID')): ?>
              <a href="{{ url('lessons/browse/all')}}" class="btn btn-default btn-lg">Browse</a>
            <?php else: ?>
              <a href="{{ url('member/signup')}}" class="btn btn-default btn-lg">Buat Akun</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- ./END CALL TO ACTION -->

@push('js')



@endpush
