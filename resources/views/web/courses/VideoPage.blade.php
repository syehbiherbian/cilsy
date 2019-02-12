@extends('web.app')
@section('title','')
@section('content')
    <section id="wrapper">
      
      <!-- THE PLAYLIST -->
      <div id="sidebar-wrapper">
        <div class="tabs-video">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" id="pills-materi-tab" data-toggle="pill" href="#pills-materi" role="tab" aria-controls="pills-materi" aria-selected="true">Materi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-diskusi-tab" data-toggle="pill" href="#pills-diskusi" role="tab" aria-controls="pills-diskusi" aria-selected="false">Diskusi</a>
            </li>
            <div class="tabs-close">
              <a class="btn btn-menu c-blue" onclick="sidebarShow()">
                <i class="fa fa-times"></i>
              </a>
            </div>
          </ul>
        </div>

        
        <div class="tab-content" id="pills-tabContent">
          <!-- Tab Materi -->
          <div class="tab-pane fade active in" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
              <div class="video-materi">
                <div class="number-circle">1</div>
                <a class="collap" id="materi-1" data-toggle="collapse" href="#materi1" role="button">
                  <div class="number-circle">1</div>
                  <div class="title">
                    Introducion
                    <h6><span class="fa fa-clock"></span> 40:48</h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>    
              </div>

              <div class="collapse submateri" id="materi1">
                <ul>
                  <li>
                    <a href="#">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 1. Why Linux? Why Sysadmin? Why now?
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="active">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 2. Why you should trust me as your instructur ?
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 3. Why you should take this course?
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                            <i class="fas fa-play-circle"></i> 4. Apa saja perangkat dan software yang digunakan?
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                            <i class="fas fa-play-circle"></i> 5.  Getting all files for the rest of course
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i> 6. FAQ
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          05:10
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>


              <div class="video-materi">
                <a class="collap" id="collapse" data-toggle="collapse" href="#collapseLesson" role="button">
                  <div class="number-circle">2</div>
                  <div class="title">
                    Linux dan Open Source
                    <h6><span class="fa fa-clock"></span> 30:48</h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>    
              </div>

              <div class="video-materi">
                <a class="collap" id="collapse" data-toggle="collapse" href="#collapseLesson" role="button">
                  <div class="number-circle">3</div>
                  <div class="title">
                      Linux Ubuntu Installation
                    <h6><span class="fa fa-clock"></span> 45:28</h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>    
              </div>
              
              <div class="video-materi">
                <a class="collap" id="collapse" data-toggle="collapse" href="#collapseLesson" role="button">
                  <div class="number-circle">4</div>
                  <div class="title">
                    Basic Linux Administration
                    <h6><span class="fa fa-clock"></span> 41:05</h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>                      
              </div>
          </div>

          <!-- Tab Diskusi-->
          <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
              <div class="row box m-4">
                <div class="col-xs-12">
                  <h6>Buat Pertanyaan</h6>
                  <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="10"></textarea>
                  <br>
                  <button class="btn btn-primary mb-2">Upload Gambar</button>
                  <button class="btn btn-primary mb-2">Tambah Pertanyaan</button>
                </div>

                <hr class="mb-5">

                <div class="col-xs-12">
                  <hr>
                  <span class="text-muted">Saat ini belum ada diskusi</span>
                </div>

              </div>
          </div>
        </div>

      </div>

      <div class="container-fluid p-0">
        <div class="row m-0 p-0"  id="page-content-wrapper" >

            <div class="col-xs-12 p-0">

            <!-- THE VIDEO PLAYER -->
              <video id="player" playsinline controls>
                <source class="vid-player" src="" type="video/mp4">
              </video>

              <div class="player-end">
                <div class="align-items-center">
                  <div class="col-xs-12 text-center">  
                    <h5>Anda telah menyelesaikan Why you should trust me your instructor</h5>
                    <h6>Berikutnya Why you should take this course</h6>
                    <button class="btn btn-primary" onClick="changeVideo()">Lanjutkan</button>
                  </div>
                </div>
              </div>

            </div>

        </div>
      </div>

    </section>


    <!-- JavaScript -->
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plyr.min.js')}}"></script>
    <script>
      //function Menu sidebar
      function sidebarShow(){
        if($("#wrapper").hasClass("toggled")){
          $("#wrapper").removeClass('toggled');
        }else{
          $("#wrapper").addClass('toggled');
        }
      }

      const controls = `<div class="video-header">
        <div class="col-xs-8">
          Become a Sysadmin Professional <br>
          <small>Introduction: Why Linux? Why Sysadmin? Why now?</small>
        </div>
        <div class="col-xs-3 p-0">
          <a href="CourseSylabus.html">
            <i class="fa fa-chevron-left"></i> Course Part 1 Linux Fundamental
          </a>
        </div>
        <div class="col-xs-1 p-0">
          <button type="button" class="btn btn-menu px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
        </div>
      </div>
      <div class="plyr__controls">
        <button type="button" class="plyr__control" aria-label="Play, {title}" data-plyr="play">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-pause"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-play"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Pause</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Play</span>
        </button>
        <div class="plyr__progress">
            <input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" aria-label="Seek">
            <progress class="plyr__progress__buffer" min="0" max="100" value="0">% buffered</progress>
            <span role="tooltip" class="plyr__tooltip">00:00</span>
        </div>
        <div class="plyr__time plyr__time--current" aria-label="Current time">00:00</div>
        <div class="plyr__time plyr__time--duration" aria-label="Duration">00:00</div>
        <button type="button" class="plyr__control" aria-label="Mute" data-plyr="mute">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-muted"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-volume"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Unmute</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Mute</span>
        </button>
        <div class="plyr__volume">
            <input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1" autocomplete="off" aria-label="Volume">
        </div>
        <button type="button" class="plyr__control" data-plyr="captions">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-captions-on"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-captions-off"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Disable captions</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Enable captions</span>
        </button>
        <button type="button" class="plyr__control" data-plyr="fullscreen">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-exit-fullscreen"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-enter-fullscreen"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Exit fullscreen</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Enter fullscreen</span>
        </button>
        <a href="ProjectSubmit.html" class="btn btn-next">
            Lanjutkan <i class="fa fa-step-forward"></i>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Lanjutkan Course</span>
        </a>
    </div>
    `;

    var player = new Plyr('#player', { 
      "debug": true,
      controls,
      keyboard:{
        global: true
      },
      resetOnEnd: true,
    });

    player.source = {
      type: 'video',
      title: 'Elephant Dream',
      sources: [{
        src: 'file/example.mp4',
        type: 'video/mp4',
      }]
    };

    //show overlay when video has ended
    player.on('ended', function(){
        $('.player-end').css('display', 'block'); 
    });

    //hide overlay when video play again
    player.on('playing',function(){
        $('.player-end').css('display', 'none'); 
    });


    //function for button `Lanjutkan` when video has ended
    function changeVideo(){
      $('.player-end').css('display', 'none'); 
      player.source = {
        type: 'video',
        title: 'Video 2',
        sources: [{
          src: 'file/example2.mp4',
          type: 'video/mp4',
        }]
      };
    }


    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-down').addClass('fa-chevron-up');        
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
      });
    });
    </script>
@endsection()