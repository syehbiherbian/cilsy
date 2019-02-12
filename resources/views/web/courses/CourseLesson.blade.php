@extends('web.app')
@section('title','')
@section('content')

    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header" style="background: url({{asset('img/bg-head.jpg')}});background-size: cover;padding-bottom: 80px">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h6 class="mb-5">Training to Become a Sysadmin Professional / Couse Part 1</h6>
              <h2 class="mb-4">Linux Fundamental</h2>
              <h6>
                Setelah menyelesaikan Linux Fundamental ini, diharapkan mampu memahami dasar-dasar pengoperasian
                sistem operasi Linux dan dapat menggunakannya  dalam lingkungan pekerjaan  di bidang teknologi dan sistem informasi.
              </h6>
              <br>
              <button class="btn btn-secondary btn-lg mb-2">Mulai belajar</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Content -->
      <section class="container-fluid lesson">
          <div class="row">
            <div class="col-sm-8 col-xs-12">
              <ul class="durationlesson">
                <li>08 Jam 31 Menit</li>
                <li>Deadline 2 Hari</li>
                <li>5 Projek</li>
                <li>3 Exercises</li>
              </ul>
            </div>
            <div class="col-sm-3 col-xs-10" style="margin-top:10px;">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-sm-1 col-xs-2">
              0%
            </div>
          </div>
      </section>

      <section class="mt-5">

        <!-- Container -->
        <div class="container">
          
          <!-- Content Timeline -->
          <ul class="timelines">
            <li>
              <div class="timelines-number">1</div>
              <div class="timelines-content">
                <div class="row box p-0">
                  <div class="col-xs-12">
                    <h6>Lesson 1</h6>
      
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <h4>Introducion</h4>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          1 Jam 20 Menit
                        </div>
                        <div class="col-md-2 col-sm-5 col-xs-5 mt-3">
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-1 p-0 pt-1">
                          0%
                        </div>
                    </div>
      
                    <p>
                      Pada chapter pertama di couse ini, Anda akan belajar tentang pengenalan dan gambaran umum tentang skillset menjadi
                      System Administrator Instruktur akan membawakan juga beberapa tools yang harus dikuasai oleh seorang System Administrator
                    </p>
      
                    <br>

                    <div class="collapse" id="collapseLesson">

                      <ul class="lesson-detail">
                        <li>
                            <h4><i class="fas fa-play-circle"></i> Why Linux? Why Sysadmin? Why now?</h4>
                            <div class="row">
                              <div class="col-xs-10">
                                Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                14:53 
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-check-circle"></i>
                              </div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fas fa-play-circle"></i> Why you should trust me as your instructor</h4>
                            <div class="row">
                              <div class="col-xs-10">
                                Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                14:53 
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-circle"></i>
                              </div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fas fa-play-circle"></i> Why you should take this course?</h4>
                            <div class="row">
                              <div class="col-xs-10">
                                Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                14:53 
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-circle"></i>
                              </div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fas fa-play-circle"></i> Getting all files for the rest of course</h4>                            
                            <div class="row">
                              <div class="col-xs-10">
                                Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                14:53 
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-circle"></i>
                              </div>
                            </div>
                        </li>
                        <li>
                            <h4><i class="fas fa-play-circle"></i> FAQ</h4>                            
                            <div class="row">
                              <div class="col-xs-10">
                                Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                14:53 
                              </div>
                              <div class="col-xs-1 p-0">
                                <i class="fa fa-circle"></i>
                              </div>
                            </div>
                        </li>
                      </ul>

                    </div>
                        
                  </div>
                  <div class="col-xs-12 px-5 py-3 bg-grey">
                      <a class="collap" id="collapse" data-toggle="collapse" href="#collapseLesson" role="button"><span>Lihat Detail Lesson <i class="fa fa-chevron-down"></i></span></a>
                      <button class="btn btn-primary float-right">Mulai Belajar</button>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="timelines-number">2</div>
              <div class="timelines-content">
                <div class="row box p-0">
                  <div class="col-xs-12">
                    <h6>Lesson 2</h6>
      
                    <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                        <h4>Introducion</h4>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-6">
                        1 Jam 20 Menit
                      </div>
                      <div class="col-md-2 col-sm-5 col-xs-5 mt-3">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                      </div>
                      <div class="col-sm-1 col-xs-1 p-0 pt-1">
                        0%
                      </div>
                    </div>
      
                    <p>
                      Pada chapter pertama di couse ini, Anda akan belajar tentang pengenalan dan gambaran umum tentang skillset menjadi
                      System Administrator Instruktur akan membawakan juga beberapa tools yang harus dikuasai oleh seorang System Administrator
                    </p>
      
                    <br>

                    <div class="collapse" id="collapseLesson2">

                        <ul class="lesson-detail">
                          <li>
                              <h4><i class="fas fa-play-circle"></i> Why Linux? Why Sysadmin? Why now?</h4>
                              <div class="row">
                                <div class="col-xs-10">
                                  Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                                </div>
                                <div class="col-sm-1 col-xs-2 p-0">
                                  14:53 
                                </div>
                                <div class="col-xs-1 p-0">
                                  <i class="fa fa-check-circle"></i>
                                </div>
                              </div>
                          </li>
                          <li>
                              <h4><i class="fas fa-play-circle"></i> Why you should trust me as your instructor</h4>
                              <div class="row">
                                <div class="col-xs-10">
                                  Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                                </div>
                                <div class="col-sm-1 col-xs-2 p-0">
                                  14:53 
                                </div>
                                <div class="col-xs-1 p-0">
                                  <i class="fa fa-circle"></i>
                                </div>
                              </div>
                          </li>
                          <li>
                              <h4><i class="fas fa-play-circle"></i> Why you should take this course?</h4>
                              <div class="row">
                                <div class="col-xs-10">
                                  Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                                </div>
                                <div class="col-sm-1 col-xs-2 p-0">
                                  14:53 
                                </div>
                                <div class="col-xs-1 p-0">
                                  <i class="fa fa-circle"></i>
                                </div>
                              </div>
                          </li>
                          <li>
                              <h4><i class="fas fa-play-circle"></i> Getting all files for the rest of course</h4>                            
                              <div class="row">
                                <div class="col-xs-10">
                                  Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                                </div>
                                <div class="col-sm-1 col-xs-2 p-0">
                                  14:53 
                                </div>
                                <div class="col-xs-1 p-0">
                                  <i class="fa fa-circle"></i>
                                </div>
                              </div>
                          </li>
                          <li>
                              <h4><i class="fas fa-play-circle"></i> FAQ</h4>                            
                              <div class="row">
                                <div class="col-xs-10">
                                  Dengarkan Fakhri Abdillah memberikan gambaran secara umum dari materi yang dipelajari di kekeseluruhan Tutorial ini   
                                </div>
                                <div class="col-sm-1 col-xs-2 p-0">
                                  14:53 
                                </div>
                                <div class="col-xs-1 p-0">
                                  <i class="fa fa-circle"></i>
                                </div>
                              </div>
                          </li>
                        </ul>

                    </div>
                        
                  </div>
                  <div class="col-xs-12 px-5 py-3 bg-grey">
                    <a class="collap" id="collapse2" data-toggle="collapse" href="#collapseLesson2" role="button">Lihat Detail Lesson <i class="fa fa-chevron-down"></i></a>
                    <button class="btn btn-primary float-right">Mulai Belajar</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>

        </div>

      </section>

    </main>


    <!-- Javascript -->
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget).html('Sembunyikan Detail Lesson <i class="fa fa-chevron-up"></i>'); 
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget).html('Lihat Detail Lesson <i class="fa fa-chevron-down"></i>'); 
      });
    });
    </script>
@endsection()