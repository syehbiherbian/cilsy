@extends('web.app')
@section('title',$lessons->title.' | ')
@section('content')
{{--  <link href="{{ asset('node_modules/video.js/dist/video-js.css') }}" rel="stylesheet">  --}}
<link href="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.vertical.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
<link href="https://vjs.zencdn.net/5.16.0/video-js.min.css" rel="stylesheet"/>
<script src="https://vjs.zencdn.net/5.16.0/video.min.js"></script>
<script src="https://rawgit.com/atlance01/vrapp-ionic/master/www/js/lib/videojs-playlist.js"></script>
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

<div id="content-section">

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
        <button class="previous" hidden>Previous</button>
        <button class="next" hidden>Next</button>
        <button class="jump" hidden>Play Third</button>
      </div>
      <div class="description-dekstop hidden-xs">
        <ul class="tablist" role="tablist">
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel1">Deskripsi Tutorial</a></li>
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel2">Daftar Materi</a></li>
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel3">Berkas Praktek</a></li>
          <li class="tab" role="tab"><a data-toggle="tab" href="#panel4">Komentar</a></li>
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
              <?php if ($services) {?>
              <span class="pull-right"><a href="{{ $row->video }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download Video</a></span>
              <?php }?>
              <p><?=nl2br($row->description);?></p>
            </li>
            <?php }?>
            
          </ul>

        </div>
        <div class="tabpanel" id="panel3" role="tabpanel">
          <h1>File Praktek</h1>
          <?php if ($services) {?>
              @foreach($file as $key => $files)
                  <a href="{{ $files->source }}" class="btn btn-info btn-md" download><i class="fa fa-download"></i> Download {{ $files->title}}</a><br><br>
              @endforeach

          <?php } else {?>
              <button type="button" name="button"  class="btn btn-info btn-md disabled"><i class="fa fa-download"></i> Download </button>
          <?php }?>

        </div>
        <div class="tabpanel" id="panel4" role="tabpanel">
          <div class="container" style="margin-top:50px;">
            <div class="col-md-12" style="background-color:#fff;">
                <h3>Pertanyaan</h3>
                <hr>

                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="input_kirim" name="input_kirim" rows="8" cols="80"></textarea>
                    </div>
                    <div class="col-md-12" id="kirim" style="padding-top:10px;padding-left:5%;padding-bottom:20px;">
                        <a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dokirim()" style="float:right;margin-top:10px;">Kirim</a>'
                    </div>
                </div>
                <div class="content-reload">

                    @foreach($datacomment as $comment)
                    <div class="col-md-12" style="margin-bottom:30px;" id="row{{ $comment->id }}">
                        <img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">
                        <strong>{{ $comment->username }} </strong> pada <strong><?= date('d/m/Y',strtotime($comment->created_at)) ?></strong>
                        <strong style="color:#ff5e10;">@if($comment->member_id !==null)  User @endif @if($comment->contributor_id  !==null)  Contributor @endif</strong>

                        <div class="col-md-12" style="margin-top:10px;padding-left:5%;">
                                {{ $comment->description }}
                        </div>
                            <br><br>
                            <?php
                            $getchild = DB::table('coments')
                                ->leftJoin('members','members.id','=','coments.member_id')
                                ->leftJoin('contributors','contributors.id','=','coments.contributor_id')
                                ->where('coments.lesson_id',$lessons->id)
                                ->where('parent',$comment->id)
                                ->orderBy('coments.created_at','ASC')
                                ->select('coments.*','members.username as username','contributors.username as contriname')
                                ->get();

                            if (count($getchild) > 0) {
                                foreach ($getchild as $child) {
                            ?>
                            <div class="col-md-12" style="margin-top:10px;padding-left:7%;">
                                <img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">
                                    <strong>
                                        <?php if(!empty($child->username)){ ?>
                                            {{ $child->username }}
                                        <?php }else{ ?>
                                            {{ $child->contriname }}
                                        <?php } ?>
                                    </strong> pada <strong><?= date('d/m/Y',strtotime($child->created_at)) ?></strong>
                                    <strong style="color:#ff5e10;">@if($child->member_id !==null)  User @endif @if($child->contributor_id  !==null)  Contributor @endif</strong>
                                    <div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%;">
                                        {{ $child->description }}
                                    </div>
                                    <div class="clearfix"></div>
                            </div>
                            <?php
                                }
                            }
                            ?>



                        <div class="col-md-12" id="balas{{ $comment->id }}" style="padding-top:10px; padding-left:0px; padding-right:0px;">
                            <a href="javascript:void(0)" class="btn btn-info pull-right" onclick="formbalas({{ $comment->id }})">Balas</a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
  </div>
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


  <script src="{{ asset('node_modules/video.js/dist/video.js') }}"></script>
  <script src="{{ asset('node_modules/videojs-playlist/dist/videojs-playlist.js') }}"></script>
  <script src="{{ asset('node_modules/videojs-playlist-ui/dist/videojs-playlist-ui.js') }}"></script>
  <script type="text/javascript">

    function dokirim(){
        var isi_kirim = $('#input_kirim').val();
        var lesson_id = '{{ $lessons->id }}';
        // alert(comment_id+' = '+isi_balas);
        var datapost = {
            '_token'    : '{{ csrf_token() }}',
            'isi_kirim' : isi_kirim,
            'lesson_id' : lesson_id
        }

        $.ajax({
            type    :'POST',
            url     :'{{ url("lessons/coments/kirimcomment") }}',
            data    :datapost,
            success:function(data){
            if(data==0){
                    window.location.href = '{{url("member/signin")}}';
            } else if (data !== 'null') {
                    // $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                    $('.content-reload').prepend(data);
                }else {
                    alert('Koneksi Bermasalah, Silahkan Ulangi');
                    location.reload();
                }
            }
        })
    }
</script>
  <script type="text/javascript">
      function formbalas(comment_id){

          $('#balas'+comment_id).html('<label class="col-md-1" style="padding-left:0px;">Anda</label>'+
                                  '<div class="col-md-11" style="padding-right:0px;">'+
                                  '   <input type="text" class="form-control" id="input_balas'+comment_id+'" name="balasan" placeholder="tambahkan komentar/balasan" value="">'+
                                  '</div>'+
                                  '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="dobalas('+comment_id+')" style="float:right;margin-top:10px;">Kirim</a>');
      }

      function dobalas(comment_id){
          var isi_balas = $('#input_balas'+comment_id).val();
          var lesson_id = '{{ $lessons->id }}';
          // alert(comment_id+' = '+isi_balas);
          var datapost = {
              '_token'    : '{{ csrf_token() }}',
              'isi_balas' : isi_balas,
              'comment_id': comment_id,
              'lesson_id' : lesson_id
          }

          $.ajax({
              type    :'POST',
              url     :'{{ url("lessons/coments/postcomment") }}',
              data    :datapost,
              success:function(data){
                  if (data == 1) {
                      $("#row"+comment_id).load(window.location.href + " #row"+comment_id);
                  }
                  else if(data==0){
                          window.location.href = '{{url("member/signin")}}';
                  }else {
                      alert('Koneksi Bermasalah, Silahkan Ulangi');
                      location.reload();
                  }
              }
          })
      }

      function loadcontent(){
          $(".content-reload").load(window.location.href + " .content-reload");
          console.log('reload');
      }

      // setInterval(function(){
      //     loadcontent()
      // }, 5000);
  </script>
  <script>
    fbq('track', 'ViewContent');
  </script>
  <script>
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
