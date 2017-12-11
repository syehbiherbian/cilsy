@push('css')
<link rel="stylesheet" href="{{ asset('template/web/css/video-js.css') }}">
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
          <!-- <button class="previous" hidden>Previous</button>
          <button class="next" hidden>Next</button>
          <button class="jump" hidden>Play Third</button> -->
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

</script>



@endpush
