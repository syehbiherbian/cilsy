@push('css')


@endpush

<!-- BEGIN MAIN BANNER -->
<section class="main-banner">
  <div class="container">
    <div class="row caption-area ">
      <div class="col-md-12">
        <div class="caption">
          <div class="inner">
            <p>
              Belajar dari 500++ tutorial, Networking & Server Ekslusif ini.</br>
              Bisa Bertanya dengan Trainer 24 jam.</br>
              Online. Kapanpun, Dimanapun.<br>
            </p>
            <?php if (Session::get('memberID')): ?>
              <a href="{{ url('lessons/browse/all')}}" class="daftar-btn">Browse</a>
            <?php else: ?>
              <a href="{{ url('member/signup')}}" class="daftar-btn">Daftar</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
    <div class="row card-row">
      <div class="card-area">

          <div class="col-md-4">
            <div class="card">
              <strong class="title ">Interaktif</strong>
              <p class="mt-15">Belajar dengan dukungan Trainer Profesional</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Ekslusif</strong>
              <p class="mt-15">Materi berbasis kebutuhan industri IT saat ini</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Lengkap</strong>
              <p class="mt-15">Kebutuhan belajar di dukung melalui Ebook dan File Praktek</p>
            </div>
          </div>

      </div>
    </div>
  </div>
</section><!-- ./END MAIN BANNER -->

@push('js')



@endpush
