@extends('web.app')
@section('content')
<title>Cilsy</title>
<link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">
<link href="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
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
    width: 342px;
    height: 500px;
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

</style>

<div id="content-section">

  <div id="cat-images">
    <div class="container">
      <div class="playlist-total-video">Total {{ count($main_videos) }} Video</div>
      <p class="playlist-title">
        {{ $lessons->title }}


        <!-- <a href="#" class="playlist-total-video"></a> -->
      </p>

      <div class="player-container">
        <!-- Main Video -->
        <video
          id="video"
          class="video-js"
          height="500"
          width="70%"
          controls>
          <?php if(count($main_videos) > 0){?>
              <source src="<?php if(!empty($main_videos[0]->video)){echo $main_videos[0]->video;}?>" type="<?php if(!empty($main_videos[0]->type_video)){echo $main_videos[0]->type_video;}?>">
          <?php } ?>
          <!-- <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm"> -->
        </video>
        <!-- Playlist Video -->
        <div class="vjs-playlist"></div>
      </div>
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
    <?php echo nl2br($lessons->description);?></p>
  </div>
  <div class="tabpanel" id="panel2" role="tabpanel">
    <h1>Daftar Materi</h1>
    <p>Comming Soon</p>

  </div>
  <div class="tabpanel" id="panel3" role="tabpanel">
    <h1>File Praktek</h1>
      @foreach($file as $key => $files)
          <a href="{{ $files->source }}" class="btn btn-info btn-md"> Download {{ $files->title}}</a><br><br>
      @endforeach
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
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58c547d85b89e2149e155e47/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@endsection
