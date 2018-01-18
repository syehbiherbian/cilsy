@push('css')
<link rel="stylesheet" href="{{ asset('template/web/css/video-js.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/videojs-playlist-ui.vertical.css') }}">
<link rel="stylesheet" href="{{ asset('template/web/css/video-js-custom.css') }}">
@endpush
<style>
  .video-js .vjs-menu-button-inline.vjs-slider-active,.video-js .vjs-menu-button-inline:focus,.video-js .vjs-menu-button-inline:hover,.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 10em
}

.video-js .vjs-controls-disabled .vjs-big-play-button {
    display: none!important
}

.video-js .vjs-control {
    width: 3em
}

.video-js .vjs-menu-button-inline:before {
    width: 1.5em
}

.vjs-menu-button-inline .vjs-menu {
    left: 3em
}

.vjs-paused.vjs-has-started.video-js .vjs-big-play-button,.video-js.vjs-ended .vjs-big-play-button,.video-js.vjs-paused .vjs-big-play-button {
    display: block
}

.video-js .vjs-load-progress div,.vjs-seeking .vjs-big-play-button,.vjs-waiting .vjs-big-play-button {
    display: none!important
}

.video-js .vjs-mouse-display:after,.video-js .vjs-play-progress:after {
    padding: 0 .4em .3em
}

.video-js.vjs-ended .vjs-loading-spinner {
    display: none;
}

.video-js.vjs-ended .vjs-big-play-button {
    display: block !important;
}

.video-js *,.video-js:after,.video-js:before {
    box-sizing: inherit;
    font-size: inherit;
    color: inherit;
    line-height: inherit
}

.video-js.vjs-fullscreen,.video-js.vjs-fullscreen .vjs-tech {
    width: 100%!important;
    height: 100%!important
}

.video-js {
    font-size: 14px;
    overflow: hidden
}

.video-js .vjs-control {
    color: inherit
}

.video-js .vjs-menu-button-inline:hover,.video-js.vjs-no-flex .vjs-menu-button-inline {
    width: 8.35em
}

.video-js .vjs-volume-menu-button.vjs-volume-menu-button-horizontal:hover .vjs-menu .vjs-menu-content {
    height: 3em;
    width: 6.35em
}

.video-js .vjs-control:focus:before,.video-js .vjs-control:hover:before {
    text-shadow: 0 0 1em #fff,0 0 1em #fff,0 0 1em #fff
}

.video-js .vjs-spacer,.video-js .vjs-time-control {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-flex: 1 1 auto;
    -moz-box-flex: 1 1 auto;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

.video-js .vjs-time-control {
    -webkit-box-flex: 0 1 auto;
    -moz-box-flex: 0 1 auto;
    -webkit-flex: 0 1 auto;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    width: auto
}

.video-js .vjs-time-control.vjs-time-divider {
    width: 14px
}

.video-js .vjs-time-control.vjs-time-divider div {
    width: 100%;
    text-align: center
}

.video-js .vjs-time-control.vjs-current-time {
    margin-left: 1em
}

.video-js .vjs-time-control .vjs-current-time-display,.video-js .vjs-time-control .vjs-duration-display {
    width: 100%
}

.video-js .vjs-time-control .vjs-current-time-display {
    text-align: right
}

.video-js .vjs-time-control .vjs-duration-display {
    text-align: left
}

.video-js .vjs-play-progress:before,.video-js .vjs-progress-control .vjs-play-progress:before,.video-js .vjs-remaining-time,.video-js .vjs-volume-level:after,.video-js .vjs-volume-level:before,.video-js.vjs-live .vjs-time-control.vjs-current-time,.video-js.vjs-live .vjs-time-control.vjs-duration,.video-js.vjs-live .vjs-time-control.vjs-time-divider,.video-js.vjs-no-flex .vjs-time-control.vjs-remaining-time {
    display: none
}

.video-js.vjs-no-flex .vjs-time-control {
    display: table-cell;
    width: 4em
}

.video-js .vjs-progress-control {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    height: .5em;
    top: -.5em
}

.video-js .vjs-progress-control .vjs-load-progress,.video-js .vjs-progress-control .vjs-play-progress,.video-js .vjs-progress-control .vjs-progress-holder {
    height: 100%
}

.video-js .vjs-progress-control .vjs-progress-holder {
    margin: 0
}

.video-js .vjs-progress-control:hover {
    height: 1.5em;
    top: -1.5em
}

.video-js .vjs-control-bar {
    -webkit-transition: -webkit-transform .1s ease 0s;
    -moz-transition: -moz-transform .1s ease 0s;
    -ms-transition: -ms-transform .1s ease 0s;
    -o-transition: -o-transform .1s ease 0s;
    transition: transform .1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-control-bar,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-control-bar {
    visibility: visible;
    opacity: 1;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateY(3em);
    -moz-transform: translateY(3em);
    -ms-transform: translateY(3em);
    -o-transform: translateY(3em);
    transform: translateY(3em);
    -webkit-transition: -webkit-transform 1s ease 0s;
    -moz-transition: -moz-transform 1s ease 0s;
    -ms-transition: -ms-transform 1s ease 0s;
    -o-transition: -o-transform 1s ease 0s;
    transition: transform 1s ease 0s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive .vjs-progress-control {
    height: .25em;
    top: -.25em;
    pointer-events: none;
    -webkit-transition: height 1s,top 1s;
    -moz-transition: height 1s,top 1s;
    -ms-transition: height 1s,top 1s;
    -o-transition: height 1s,top 1s;
    transition: height 1s,top 1s
}

.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-active.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-paused.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-active.vjs-fullscreen .vjs-progress-control,.video-js.not-hover.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control,.video-js.vjs-has-started.vjs-playing.vjs-user-inactive.vjs-fullscreen .vjs-progress-control {
    opacity: 0;
    -webkit-transition: opacity 1s ease 1s;
    -moz-transition: opacity 1s ease 1s;
    -ms-transition: opacity 1s ease 1s;
    -o-transition: opacity 1s ease 1s;
    transition: opacity 1s ease 1s
}

.video-js.vjs-live .vjs-live-control {
    margin-left: 1em
}

.video-js .vjs-big-play-button {
    top: 50%;
    left: 50%;
    margin-left: -1em;
    margin-top: -1em;
    width: 2em;
    height: 2em;
    line-height: 2em;
    border: none;
    border-radius: 50%;
    font-size: 3.5em;
    background-color: rgba(0,0,0,.45);
    color: #fff;
    -webkit-transition: border-color .4s,outline .4s,background-color .4s;
    -moz-transition: border-color .4s,outline .4s,background-color .4s;
    -ms-transition: border-color .4s,outline .4s,background-color .4s;
    -o-transition: border-color .4s,outline .4s,background-color .4s;
    transition: border-color .4s,outline .4s,background-color .4s
}

.video-js .vjs-menu-button-popup .vjs-menu {
    left: -3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-content {
    background-color: transparent;
    width: 12em;
    left: -1.5em;
    padding-bottom: .5em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item,.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-title {
    background-color: #151b17;
    margin: .3em 0;
    padding: .5em;
    border-radius: .3em
}

.video-js .vjs-menu-button-popup .vjs-menu .vjs-menu-item.vjs-selected {
    background-color: #2483d5
}

.video-js .vjs-big-play-button {
    background-color: rgba(14,34,61,0.7);
    font-size: 3.5em;
    border-radius: 12%;
    height: 1.4em !important;
    line-height: 1.4em !important;
    margin-top: -0.7em !important
}

.video-js:hover .vjs-big-play-button,.video-js .vjs-big-play-button:focus,.video-js .vjs-big-play-button:active {
    background-color: #0e223d
}

.video-js .vjs-loading-spinner {
    border-color: rgba(14,34,61,0.84)
}

.video-js .vjs-control-bar2 {
    background-color: #0e223d
}

.video-js .vjs-control-bar {
    background-color: #0e223d !important;
    color: #ffffff;
    font-size: 14px
}

.video-js .vjs-play-progress,.video-js  .vjs-volume-level {
    background-color: rgba(14,34,61,0.8)
}
.video-holder,
.video-holder * {
  box-sizing: border-box !important
}

.video-holder {
  background: #1b1b1b;
  padding: 10px
}

.centered {
  width: 100%
}

#video {
  border-radius: 8px
}

.video-holder .vjs-big-play-button {
  left: 50%;
  width: 100px;
  margin-left: -50px;
  height: 80px;
  top: 50%;
  margin-top: -40px
}


/* CUSTOM BUTTONS */
[class^="icon-"]:before,
[class*=" icon-"]:before {
  font-family: FontAwesome;
  font-weight: normal;
  font-style: normal;
  display: inline-block;
  text-decoration: inherit;
}
.icon-angle-left:before {
    content: "\f048";
}
.icon-angle-right:before {
    content: "\f051";
}

.video-js .icon-angle-right, .video-js .icon-angle-left {
    cursor: pointer;
    -webkit-box-flex: none;
    -moz-box-flex: none;
    -webkit-flex: none;
    -ms-flex: none;
    flex: none;
}
</style>
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

</script>



@endpush
