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
              Satu-satunya Kursus Online Jaringan & Server yang dipandu sampai bisa.</br>
              Bergabung sekarang dengan 2000++ pendaftar lainnya.</br>
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
              <p class="mt-15">Bisa konsultasi dengan Trainer Profesional via chat dan remote teamviewer</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Fleksibel</strong>
              <p class="mt-15">Belajar secara online kapanpun dimanapun sesuka hati. Bahkan bisa download semua materi.</p>
            </div>
          </div>


          <div class="col-md-4 ">
            <div class="card">
              <strong class="title ">Lengkap</strong>
              <p class="mt-15">Terdapat ratusan materi berbentuk video di dukung dengan Ebook dan File Praktek</p>
            </div>
          </div>

      </div>
    </div>
  </div>
</section><!-- ./END MAIN BANNER -->

@push('js')



@endpush
