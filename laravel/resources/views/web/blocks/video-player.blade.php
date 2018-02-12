@push('css')
<link rel="stylesheet" href="{{ asset('template/web/css/video-js.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/videojs-playlist-ui.vertical.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/video-js-custom.css') }}">
@endpush

<!-- BEGIN VIDEO PLAYER -->
<section class="video-player mb-50">
  <div class="container">
    <!-- Title -->
    <div class="row pt-25 pb-15">
      <div class="col-xs-12 col-md-10">
        <p class="lesson-title">{{ $lessons->title }}</p>
      </div>
      <div class="col-xs-12 col-md-2">
        <div class="lesson-video-count">Total {{ count($main_videos) }} Video</div>
      </div>
    </div><!--./ Title -->

    <!-- Video -->
    <div class="row">
      <div class="col-md-12">
        <div class="player-container">
          <!-- Main Video -->
          <video
            id="video"
            class="video-js vjs-default-skin vjs-big-play-centered"
            height="500"
            width="70%"
            controls>
            <?php if (count($main_videos) > 0) {?>
                <source src="<?php if (!empty($main_videos[0]->video)) {echo $main_videos[0]->video;}?>" type="<?php if (!empty($main_videos[0]->type_video)) {echo $main_videos[0]->type_video;}?>">
            <?php }?>
            <!-- <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm"> -->
          </video>

          <!-- Playlist Video -->
          <div class="vjs-playlist"></div>
          <button class="previous" hidden>Previous</button>
          <button class="next" hidden>Next</button>
          <button class="jump" hidden>Play Third</button>
        </div>
      </div>
    </div><!--./ Video -->
  </div>
</section><!-- ./VIDEO PLAYER -->

@push('js')
<script src="{{ asset('template/web/js/video.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist.js') }}"></script>
<script src="{{ asset('template/web/js/videojs-playlist-ui.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {
  getPlayList();
});

function getPlayList() {

  var lessons_id = "{{ $lessons->id }}";
  var postData =
              {
                  "_token":"{{ csrf_token() }}",
                  "lessons_id": lessons_id
              }
  var player = videojs(document.querySelector('video'), {
      inactivityTimeout: 0
    });
    try {
      // try on ios
      player.volume(1);
      // player.play();
    } catch (e) {}
    //player.playlist(videoList, 4);/// play video 5
    player.playlist(postData);
    document.querySelector('.previous').addEventListener('click', function() {
      player.playlist.previous();
    });
    document.querySelector('.next').addEventListener('click', function() {
      player.playlist.next();
    });
    document.querySelector('.jump').addEventListener('click', function() {
      player.playlist.currentItem(2); // play third
    });

    player.playlist.autoadvance(0); // play all

    Array.prototype.forEach.call(document.querySelectorAll('[name=autoadvance]'), function(el) {
      el.addEventListener('click', function() {
        var value = document.querySelector('[name=autoadvance]:checked').value;
        //alert(value);
        player.playlist.autoadvance(JSON.parse(value));
      });
    });
    
    /* ADD PREVIOUS */
    var Button = videojs.getComponent('Button');

    // Extend default
    var PrevButton = videojs.extend(Button, {
      //constructor: function(player, options) {
      constructor: function() {
        Button.apply(this, arguments);
        //this.addClass('vjs-chapters-button');
        this.addClass('icon-angle-left');
        this.controlText("Previous");
      },

      // constructor: function() {
      //   Button.apply(this, arguments);
      //   this.addClass('vjs-play-control vjs-control vjs-button vjs-paused');
      // },

      // createEl: function() {
      //   return Button.prototype.createEl('button', {
      //     //className: 'vjs-next-button vjs-control vjs-button',
      //     //innerHTML: 'Next >'
      //   });
      // },

      handleClick: function() {
        console.log('click');
        player.playlist.previous();
      }
    });

    /* ADD BUTTON */
    //var Button = videojs.getComponent('Button');

    // Extend default
    var NextButton = videojs.extend(Button, {
      //constructor: function(player, options) {
      constructor: function() {
        Button.apply(this, arguments);
        //this.addClass('vjs-chapters-button');
        this.addClass('icon-angle-right');
        this.controlText("Next");
      },

      handleClick: function() {
        console.log('click');
        player.playlist.next();
      }
    });

    // Register the new component
    videojs.registerComponent('NextButton', NextButton);
    videojs.registerComponent('PrevButton', PrevButton);
    //player.getChild('controlBar').addChild('SharingButton', {});
    player.getChild('controlBar').addChild('PrevButton', {}, 0);
    player.getChild('controlBar').addChild('NextButton', {}, 2);
  $.ajax({
    type: "POST",
    url: "{{ url('lessons/getplaylist')}}",
    data: postData,
    dataType: "json",
    beforeSend: function() {
      // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
    },
    success: function (data){

      // Adding Playlist
      var player = videojs('video');
      player.playlist(data);
      player.playlistUi();


      // player.DurationDisplay( player,[options] )
    }
  });
}

// Video ended
var video = videojs('video').ready(function(){
  var player = this;

  player.on('ended', function() {
    var videosrc = player.currentSrc();
    videoTracking(videosrc);
    lessonsQuiz(videosrc);
  });
});


function videoTracking(videosrc) {
  var postData =
              {
                  "_token":"{{ csrf_token() }}",
                  "videosrc": videosrc
              }
  $.ajax({
    type: "POST",
    url: "{{ url('lessons/videoTracking')}}",
    data: postData,
    // dataType: "json",
    beforeSend: function() {
      // $('#hasil').html('<tr><td colspan="6">Loading...</td></tr>');
    },
    success: function (data){

      if (data == true) {
        console.log('Viewers has been updated');
      }

    }
  });
}
function lessonsQuiz(videosrc) {
  var postData =
              {
                  "_token":"{{ csrf_token() }}",
                  "videosrc": videosrc
              }
  $.ajax({
    type: "POST",
    url: "{{ url('lessons/LessonsQuiz')}}",
    data: postData,
    // dataType: "json",
    beforeSend: function() {
      
    },
    success: function (data){
      swal({
        title: 'Selamat!',
        text: "Anda harus menyelesaikan quiz berupa pertanyaan pilihan ganda untuk melanjutkan ke video tutorial selanjutnya. Silahkan klik mulai untuk memulai quiz",
        type: 'success',
        confirmButtonColor: '#ad0d0d',
        confirmButtonText: 'MULAI',
        allowEnterKey: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
      });
      var video = videojs('video').ready(function(){
        var player = this;
        player.pause();
      });
      if (data == true) {
        console.log('Viewers has been updated');
      }

    }
  });
}

</script>



@endpush
