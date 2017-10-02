@extends('web.app')
@section('title',$lessons->title.' | ')
@section('content')
<link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">
<link href="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
<script>
fbq('track', 'ViewContent', {
value: 3.50,
currency: 'USD'
});
</script>
<style>
  body {
    /*font-family: Arial, sans-serif;*/
  }

  .info {
    background-color: #eee;
    border: thin solid #333;
    border-radius: 3px;
    margin: 0 0 20px;
    padding: 0 5px;
  }

  /*
    We include some minimal custom CSS to make the playlist UI look good
    in this context.
  */
  .player-container {
    background: #1a1a1a;
    overflow: auto;
    width: 100%;
  }

  .video-js {
    float: left;
  }

  .vjs-playlist {
    float: left;
    width: 100%;
    height: 500px;
  }
  @media (min-width:768px) {
    .vjs-playlist {
        width: 35%;
    }
  }

  .vjs-mouse.vjs-playlist cite{
    font-size: 13px;
  }
  .vjs-mouse.vjs-playlist .vjs-playlist-description{
    font-size: 13px;
  }
  .vjs-playlist .vjs-playlist-thumbnail{
    background: transparent;
  }
  .vjs-mouse.vjs-playlist .vjs-playlist-item{
    height: 69px;
  }
  .tablist {
  position: relative;
  margin: 0;
  padding: 0;
  list-style: none;
  display: table;
  width: 100%;
}

.tab {
  position: relative;
  background-color: #eee;
  display: table-cell;
  margin-right: -4px;
  text-transform: uppercase;
  text-align: center;
  transform: background-color 1s;
  border-left: solid 1px #ddd;
  border-top: solid 1px #ddd;
}

.tab:last-child {
  border-right: solid 1px #ddd;
}

.tab a {
  position: relative;
  display: block;
  padding: 15px 20px;
  color: #666;
  text-decoration: none;
  z-index: 1;
}

.tab:after {
  content: '';
  position: absolute;
  top: 100%;
  left: -1px;
  right: -1px;
  bottom: -1px;
  background: #fff;
  border-top: solid 5px transparent;
  transition: top .2s;
}

.tab-active:after {
  top: -1px;
}

.tab-active:first-child:after {
  border-top-color: #ff5e10;
}

.tab-active:nth-child(2):after {
   border-top-color: #00ceee;
}

.tab-active:nth-child(3):after {
   border-top-color: #ffd600;
}

.tabpanel {
  display: none;
  padding: 20px;
  background: #fff;
}

.tabpanel.show {
  display: block;
}

.tabpanel h1 {
  margin: 0 0 .3em;
}

.tabpanel p {
  margin: 0 0 1.5em;
}

#panel1 h1 {
  color: #ff5e10;
}

#panel2 h1 {
  color: #00ceee;
}

#panel3 h1 {
  color: #ffd600;
}

.tab-menu {
  display: none;
}

@media (max-width: 600px) {
  .tab {
    display: block;
    display: none;
    margin: 0;
    border: none;
  }

  .tab:after {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .tab-active {
    display: block;
    top: 0;
  }

  .tab a {
    border-bottom: solid 1px #ddd;
  }

  .tab-menu {
    display: block;
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -12px;
    width: 24px;
    height: 22px;
  }

  .tab-menu .line {
    height: 4px;
    background-color: #333;
    border-radius: 2px;
    margin-bottom: 4px;
  }
}

/* Page style */

*,
*:after,
*:before {
  box-sizing: border-box;
}

.description-mobile .panel-default>.panel-heading{
  background-color: #fff;
}
.description-mobile .panel-title>.small, .description-mobile .panel-title>.small>a, .description-mobile .panel-title>a, .description-mobile .panel-title>small, .description-mobile .panel-title>small>a{
  display: block;
  text-decoration: none;
}

.materi_list{
  padding:0px;
  list-style: none;
}

.materi_list li{
  border-bottom: 1px solid #eee;
  padding: 15px 0px 0px 0px;
}
.materi_list li:last-of-type{

  border-bottom: none;

}
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

video-js.vjs-ended .vjs-big-play-button,.video-js.vjs-paused .vjs-big-play-button,.vjs-paused.vjs-has-started.video-js .vjs-big-play-button {
    display: block
}

.video-js .vjs-big-play-button {
    top: 50%;
    left: 50%;
    margin-left: -1.5em;
    margin-top: -1em
}

.video-js .vjs-big-play-button {
    background-color: rgba(0,0,0,0.45);
    font-size: 3.5em;
    border-radius: 50%;
    height: 2em !important;
    line-height: 2em !important;
    margin-top: -1em !important
}

.video-js:hover .vjs-big-play-button,.video-js .vjs-big-play-button:focus,.video-js .vjs-big-play-button:active {
    background-color: rgba(36,131,213,0.9)
}

.video-js .vjs-loading-spinner {
    border-color: rgba(36,131,213,0.8)
}

.video-js .vjs-control-bar2 {
    background-color: #000000
}

.video-js .vjs-control-bar {
    background-color: rgba(0,0,0,0.3) !important;
    color: #ffffff;
    font-size: 14px
}

.video-js .vjs-play-progress,.video-js  .vjs-volume-level {
    background-color: #2483d5
}
</style>

<div id="content-section" style="margin-top: 90px;">

  <div id="cat-images">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-10">
          <p class="playlist-title">
            {{ $lessons->title }}
            <!-- <a href="#" class="playlist-total-video"></a> -->
          </p>
        </div>
        <div class="col-xs-12 col-md-2">
          <div class="playlist-total-video">Total {{ count($main_videos) }} Video</div>
        </div>
      </div>


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
      </div>
      <div class="description-dekstop hidden-xs">
        <ul class="tablist" role="tablist">
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel1">Deskripsi Tutorial</a></li>
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel2">Daftar Materi</a></li>
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel3">File Praktek</a></li>
          <li class="tab-menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
          </li>
        </ul>

        <div class="tabpanel" id="panel1" role="tabpanel">
          <h1>Deskripsi Tutorial</h1>
          <p>
          <?php echo nl2br($lessons->description); ?></p>
        </div>
        <div class="tabpanel" id="panel2" role="tabpanel">
          <h1>Daftar Materi</h1>
          <ul class="materi_list">
            <?php foreach ($main_videos as $row) {?>
            <li>
              <strong><?=nl2br($row->title);?></strong>
              <p><?=nl2br($row->description);?></p>
            </li>
            <?php }?>
          </ul>

        </div>
        <div class="tabpanel" id="panel3" role="tabpanel">
          <h1>File Praktek</h1>
          <?php if ($services) {?>
              @foreach($file as $key => $files)
                  <a href="{{ $files->source }}" class="btn btn-info btn-md"> Download {{ $files->title}}</a><br><br>
              @endforeach

          <?php } else {?>
              <button type="button" name="button"  class="btn btn-info btn-md disabled">Download </button>
          <?php }?>

        </div>


      </div>
      <div class="description-mobile hidden-sm hidden-md hidden-lg">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                  Deskripsi Tutorial</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                  <p><?php echo nl2br($lessons->description); ?></p>
                </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                      Daftar Materi</a>
                    </h4>
                  </div>
                  <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul class="materi_list">
                        <?php foreach ($main_videos as $row) {?>
                        <li>
                          <strong><?=nl2br($row->title);?></strong>
                          <p><?=nl2br($row->description);?></p>
                        </li>
                        <?php }?>
                      </ul>
                    </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                          File Praktek</a>
                        </h4>
                      </div>
                      <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                        <?php if ($services) {?>
                        @foreach($file as $key => $files)
                            <a href="{{ $files->source }}" class="btn btn-info btn-md"> Download {{ $files->title}}</a><br><br>
                        @endforeach

                        <?php } else {?>
                            <button type="button" name="button"  class="btn btn-info btn-md disabled">Download </button>
                        <?php }?>
                        </div>
                        </div>
                      </div>
                    </div>
      </div>

    </div>
  </div>
</div>


  <script src="{{ asset('node_modules/video.js/dist/video.js') }}"></script>
  <script src="{{ asset('node_modules/videojs-playlist/dist/videojs-playlist.js') }}"></script>
  <script src="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.js') }}"></script>
  <script>
    var lessons_id = "{{ $lessons->id }}";

    var postData =
                {
                    "_token":"{{ csrf_token() }}",
                    "lessons_id": lessons_id
                }
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
        player.DurationDisplay( player,[options] )

      }
    });

  </script>
  <script>
    (function() {

function activateTab() {
    if(activeTab) {
      resetTab.call(activeTab);
    }
    this.parentNode.className = 'tab tab-active';
    activeTab = this;
    activePanel = document.getElementById(activeTab.getAttribute('href').substring(1));
    activePanel.className = 'tabpanel show';
    activePanel.setAttribute('aria-expanded', true);
  }

  function resetTab() {
    activeTab.parentNode.className = 'tab';
    if(activePanel) {
      activePanel.className = 'tabpanel hide';
      activePanel.setAttribute('aria-expanded', false);
    }
  }

  var doc = document,
      tabs = doc.querySelectorAll('.tab a'),
      panels = doc.querySelectorAll('.tabpanel'),
      activeTab = tabs[0],
      activePanel;

  activateTab.call(activeTab);

  for(var i = tabs.length - 1; i >= 0; i--) {
    tabs[i].addEventListener('click', activateTab, false);
  }

})();
  </script>
    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
@endsection
