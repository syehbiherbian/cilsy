@push('css')


@endpush

<section class="intro" style="margin-bottom: 0px; padding: 20px;">
  <div class="container">
    <div class="row ">
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner">
            <?php if (Session::get('memberID')): ?>
              <h2 style="margin-top: 4px;">Perpanjang Paket Sekarang</h2>
            <?php else: ?>
                <h2 style="margin-top: 4px;">Akses ke semua tutorial sekarang!</h2>
            <?php endif;?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="middle-wrap">
          <div class="inner text-center">
            <?php if (Session::get('memberID')): ?>
              <a href="{{ url('member/packages')}}" class="btn btn-default btn-lg">Pilih Paket</a>
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
