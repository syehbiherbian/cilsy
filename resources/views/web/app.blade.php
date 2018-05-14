<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="4yTZI7aHiFWK-AD03jB5ffbkI5Q8svP423zsKLmtp4I" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title') {{ config('app.name') }}</title>
    <link href="{{asset('template/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/video-js.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/navbar.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/pace.css')}}" rel="stylesheet">
    <!-- rating -->
    <link rel="stylesheet" href="{{ asset('template/web/css/star-rating.min.css') }}" />
    <!-- rating -->
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/owl.theme.green.min.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{asset('template/kontributor/img/logo-only.png')}}"/>
    <link rel="stylesheet" href="{{ asset('template/web/plugins/ionicons-2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Jquery UI   -->


    <link rel="stylesheet" href="{{ asset('template/web/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <script type="text/javascript" src="{{asset('template/web/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert2@7.9.2/dist/sweetalert2.all.js"></script>
    <!-- Jquery UI   -->
    <script type="text/javascript" src="{{ asset('template/web/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/owl.carousel.js') }}"></script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '121629818418908'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=121629818418908&ev=PageView&noscript=1"
    /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
    <!-- start Mixpanel -->
    <script type="text/javascript">
    // (function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
    // 0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
    // for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
    // mixpanel.init("b208ef84bd5045e39433ef24aa0b823c");
    </script>
    <!-- end Mixpanel -->
{{--     <?php if (Session::get('memberID'));{?>
    <script>
    document.onkeydown = function(e) {
    if(event.keyCode == 123) {
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    return false;
    }
    }
    </script>
    <?php }?> --}}
    <style media="screen">
    .owl-prev {
    width: 15px;
    height: 100px;
    position: absolute;
    top: 40%;
    margin-left: -20px;
    display: block!IMPORTANT;
    border:0px solid black;
    }
    .owl-next {
        width: 15px;
        height: 100px;
        position: absolute;
        top: 40%;
        right: -25px;
        display: block!IMPORTANT;
        border:0px solid black;
    }
    .owl-prev i, .owl-next i {transform : scale(1,6); color: #333;}
    .loading{
        position: fixed;
        background: #2BA8E2;
        left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
        z-index: 9999999;
    }
    .middle{
        display: table;
        width: 100%;
        height: 100vh;
        text-align: center;
    }
    .middle-item{
        display: table-cell;
        vertical-align: middle;
        /*width: 100%;
        height: 100vh;*/
    }
      .drop-down{
        position: relative;
        display: inline-block;
      }
      .drop-down-content{
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        /* min-width: 160px; */
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-left: -270px;
        right: 0px;
        padding: 15px;
      }
      .drop-down:hover .drop-down-content,.drop-down:focus .drop-down-content ,.drop-down:active .drop-down-content {
        display: block;
      }
      .btn-package{
        margin-right: 5px
      }
      /*.btn-signout{
        margin-right: 5px
      }*/
      @media (min-width: 768px){
        .navbar-form {
          width: 29%;
      }
      }
      @media (min-width: 768px){
        .navbar-nav>li {
            padding-top: 9px;
            padding-bottom: 9px;
            margin-top: 7px;
        }
      }
      .navbar-form {
          margin-top: 13px;
          background: #eee;
          padding: 5px;
          margin-left: 25px;
          margin-right: 0px;
      }
      @media (max-width:768px) {
        .navbar-form {
            margin-top: 13px;
            background: #eee;
            padding: 5px;
            margin-left: 0px;
            margin-right: 0px;
        }
      }
      @media (min-width:768px) {
        #bs-example-navbar-collapse-search{
          display: none !important;
          animation: slideInLeft 1s;
          left: 0px;
        }
      }
      #bs-example-navbar-collapse-search p{
        border-bottom: 1px solid #fff;
        padding-bottom: 5px;
        color: #fff;
      }
      #bs-example-navbar-collapse-search .dropdown-menu{
        position: relative;
      }
      .navbar-toggle.navbar-left {
  float: left;
  margin-left: 10px;
}
.navbar-toggle{
  float:left
}
.search-toogle {
    font-size: 20px;
    color: #fff;
    padding-top: 4px;
    float:right;
    padding-bottom: 0px;
}
@media (max-width:768px) {
  .navbar-default .logo{
    height: 40px;
    position: absolute;
    left: 0;
    right: 0;
    display: block;
    margin: 0 auto;
    margin-top: -10px;
  }
}
.navbar-brand {
    float: left;
    height: 50px;
    padding: 15px;
    font-size: 18px;
    line-height: 20px;
    text-align: center;

}
      .global-notification {
    background: #FFEB3B;
    color: #fffff;
    text-align: center;
}
.navbar-form .btn-category .btn {
    padding: 10px 12px;
    background: #fff;
    width: 59%;
}
.navbar-form .form-control {
    height: 43px;
    padding-left: 25%;
}
.input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group {
    margin-right: 70px;
}
  #btn {
  position: fixed;
  z-index: 5;
  top: 15px;
  left: 15px;
  cursor: pointer;
  transition: left 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}
#btn div {
  width: 35px;
  height: 2px;
  margin-bottom: 8px;
  background-color: #fff;
  transition: opacity 500ms, background-color 250ms, -webkit-transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
  transition: transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, background-color 250ms;
  transition: transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91), opacity 500ms, background-color 250ms, -webkit-transform 500ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}

#btn.active {
  left: 310px;
}
#btn.active div {
  background-color: #fff;
}
#btn.active #top {
  -webkit-transform: translateY(10px) rotate(-135deg);
          transform: translateY(10px) rotate(-135deg);
}
#btn.active #middle {
  opacity: 0;
  -webkit-transform: rotate(135deg);
          transform: rotate(135deg);
}
#btn.active #bottom {
  -webkit-transform: translateY(-10px) rotate(-45deg);
          transform: translateY(-10px) rotate(-45deg);
}

#box {
  position: fixed;
  z-index: 4;
  overflow: auto;
  top: 0px;
  left: -275px;
  width: 300px;
  opacity: 0;
  padding: 20px 0px;
  height: 100%;
  background-color: #f6f6f6;
  color: #343838;
  transition: all 350ms cubic-bezier(0.6, 0.05, 0.28, 0.91);
}

#box.active {
  left: 0px;
  opacity: 1;
}

#items {
  position: relative;
  top: 25%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}

#items .item {
  position: relative;
  cursor: pointer;
  font-size: 18px;
  padding: 20px 20px;
  transition: all 250ms;
}
a #items .item {
  color: #343838;
  text-decoration: none;
}
#items .item:hover {
  padding: 15px 45px;
  background-color: rgba(52, 56, 56, 0.2);
}

#btn, #btn * {
  will-change: transform;
}

#box {
  will-change: transform, opacity;
}


    </style>


    <link rel="stylesheet" href="{{ asset('template/web/css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('template/web/css/blocks.css') }}">

    @stack('css')
</head>

<!-- <body oncontextmenu="return false;"> -->
<body>
    <!--<div class="loading">
        &nbsp;
        <div class="middle">
            <div class="middle-item">
                <img src="{{asset('template/web/img/logo.png')}}" alt="cilsy" class="logo">
            </div>
        </div>
    </div>-->
    <!-- Navbar -->

    <nav class="navbar navbar-default navbar-fixed-top">
    <?php if (empty(Session::get('memberID'))) {?>
    {{--  <div class="global-notification">
      <div class="container">
    <h4>
    <a href="{{ url('member/package') }}"><font color="red">Mau dapat Cashback Rp.50.000? Amankan Disini! Tersisa <font id="demo"></font> Hari lagi..</font></a>
    </h4>
    <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;' style="    position: absolute;
    right: 20px;
    top: 10px;">x</span>

    </div>  
    </div>  --}}
    <?php } ?>
      <div class="container">
        <div class="navbar-header navbar-fixed-side navbar-fixed-side-left">
          {{--  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>  --}}
          <div id="btn" class="hidden-lg hidden-md">
              <div id='top'></div>
              <div id='middle'></div>
              <div id='bottom'></div>
          </div>
          <div id="box">
            @if (Auth::guard("members")->user())
              <div id="items" style="top:38%">
                  <div class="item" style="background-color:white">Halo, {{ Auth::guard('members')->user()->username }}</div>
                  <a href="{{ url('lessons/browse/all') }}" class="hidden-lg hidden-md" style="color: #fff;"><div class="item browse" style="background-color:#2BA8E2;">Browse Tutorial</div></a>                  
                  <div class="item">Status Paket : <?=Helper::package('title');?></div>
                  <div class="item">Masa Aktif : <?=Helper::package('expired');?> hari</div>
                  <a href="{{ url('member/package') }}"><div class="item">Perpanjang</div></a>
                  <a href="{{ url('member/change') }}" ><div class="item">Ganti Password</div></a>
                  <a href="{{ url('member/signout') }}"><div class="item">Logout</div></a>
              </div>
              @else
              <div id="items">
                  <a href="{{ url('lessons/browse/all') }}" class="hidden-lg hidden-md" style="color: #fff;"><div class="item browse" style="background-color:#2BA8E2;">Browse Tutorial</div></a>
                  <a href="{{ url('/carapesan') }}"><div class="item">Cara Pesan</div></a>
                  <a href="{{ url('/member/package') }}"><div class="item">Harga</div></a>
                  <a href="{{ url('member/signin') }}"><div class="item">Masuk</div></a>
                  <a href="{{ url('member/signup') }}"><div class="item">Daftar</div></a>
              </div>
              @endif
          </div>
         
          <button type="button" class="navbar-toggle collapsed search-toogle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-search" aria-expanded="false">
            <!-- <span class="sr-only">Toggle navigation</span> -->
            <i class="ion ion-ios-search-strong"></i>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="{{asset('template/web/img/logo.png')}}"></a>
          <a href="{{ url('lessons/browse/all') }}" class="browse-btn hidden-xs hidden-sm">Browse Tutorial</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <!-- <ul class="nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul> -->
          <!-- <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form> -->
          <form class="navbar-form navbar-left form-search hidden-xs" action="{{ url('search') }}" method="get">
            <input type="hidden" name="category" value="" class="searchcategory">

            <div class="input-group">

              <div class="input-group-btn btn-category">
                <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="cate_title">
                  <i class="fa fa-th" aria-hidden="true"></i>
                  </span> <i class="ion-android-arrow-dropdown"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Linux')">Linux</a>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Mikrotik')">Mikrotik</a>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Cisco')">Cisco</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Semua Kategori')">Semua Kategori</a>
                </div>
              </div>
              <input type="text" class="form-control keyword" aria-label="Text input with dropdown button " placeholder="Search" name="q">
              <span class="input-group-btn btn-search">
                 <button class="btn btn-secondary" type="submit"><i class="ion-android-search"></i></button>
               </span>
            </div>
          </form>
          @if (Auth::guard("members")->user())
          <div class="header-menu">
                <ul>
                    <li>
                      <a href="{{ url('member/dashboard')}}" class="hello-user" style=".hello-user:hover{ text-decoration:none;}">
                        Tutorial Saya
                      </a>
                    </li>
                    <?php if(!empty(notifuser())){ ?>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                              <?php echo notifuser();?>
                            </ul>
                        </div>
                    </li>
                    <?php } else { ?>
                        <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                              Tidak Ada Pemberitahuan
                            </ul>
                        </div>
                    </li>
                    <?php } ?>
                     <li>
                        <span class="hello-user">Halo, {{ Auth::guard('members')->user()->username }}</span>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Akun.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                                <li>
                                    <a href="{{ url('member/profile')}}">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Pengaturan Akun
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('member/point')}}">
                                        Point
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('member/subscriptions')}}">
                                        Riwayat dan Status Langganan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('member/signout')}}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
          </div>
          @else
              <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ url('lessons/browse/all') }}" class="hidden-lg hidden-md">Browse Tutorial</a></li>
              <li><a href="{{ url('/carapesan') }}">Cara Pesan</a></li>
              <li><a href="{{ url('/member/package') }}">Harga</a></li>
              <li><a href="{{ url('member/signin') }}">Masuk</a></li>
              <li><a href="{{ url('member/signup') }}">Daftar</a></li>
            </ul>
          @endif
        </div><!-- /.navbar-collapse -->

        <div class="collapse navbar-collapse hidden-sm hidden-md hidden-lg" id="bs-example-navbar-collapse-search" style="overflow-y: visible;">
          <form class="navbar-form navbar-left form-search " action="{{ url('search') }}" method="get">
            <input type="hidden" name="category" value="" class="searchcategory">

            <div class="input-group">

              <div class="input-group-btn btn-category">
                <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  <span class="cate_title">
                    <i class="fa fa-th" aria-hidden="true"></i>
                  </span> <i class="ion-android-arrow-dropdown"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" >
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Linux')">Linux</a>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Mikrotik')">Mikrotik</a>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Cisco')">Cisco</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)" onclick="changeCategory('Semua Kategori')">Semua Kategori</a>
                </div>
              </div>
              <input type="text" class="form-control keyword" aria-label="Text input with dropdown button " placeholder="Search" name="q">
              <span class="input-group-btn btn-search">
                 <button class="btn btn-secondary" type="submit"><i class="ion-android-search"></i></button>
               </span>
            </div>
          </form>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
    <!--/. End Navbar -->

    <div id="header" class="hidden">
        <div class="container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{asset('template/web/img/logo.png')}}"></img>
            </a>
            <!-- <a href="{{ url('lessons/browse/all') }}" class="browse-btn">Browse Tutorial</a> -->
            <?php //Helper::searchForm(); ?>
            <div class="header-left pull-right">
              <?php if (!empty(Session::get('memberID'))) {?>
                <a href="#" class="masuk-btn">Halo, <?=Helper::member('username');?></a>
                <div class="drop-down">
                  <a href="#" style="color:#FFF" class="user-arrow">&#x25BE;</a>
                  <div class="drop-down-content">
                    <table cellpadding="15">
                      <tr>
                        <td>Status Paket</td>
                        <td>: <?=Helper::package('title');?></td>
                      </tr>
                      <tr>
                        <td>Masa Aktif</td>
                        <td>: <?=Helper::package('expired');?> hari</td>
                      </tr>
                      <tr>
                        <td><a href="{{ url('member/package') }}" class="btn btn-danger btn-package">Perpanjang</a></td>
                        <td><a href="{{ url('member/change') }}" class="btn btn-success">Ganti Password</a></td>
                        <td><a href="{{ url('member/signout') }}" class="btn btn-primary btn-signout">Logout</a></td>
                      </tr>
                    </table>
                  </div>
                </div>

              <?php } else {?>
                <a href="{{ url('member/signin') }}" class="masuk-btn">Masuk</a>
                <a href="{{ url('member/signup')}}" class="daftar-header-btn">Daftar</a>
              <?php }?>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
      @yield('content')
    </div>
        <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="footer-logo" src="{{asset('template/web/img/logo-only.png') }}" alt=""></img>
                    <span class="footer-logo-text">Cilsy</span>
                    <p>
                        Satu-satunya kursus online jaringan dan server yang dipandu sampai bisa. Terdapat ratusan video tutorial eksklusif serta trainer profesional yang siap membantu proses belajar anda.
                    </p>
                    <p class="copyrigth-text">
                        Copyright Cilsy Fiolution 2016-2017
                    </p>
                </div>
                <div class="col-md-2">

                  <?=Helper::pageMenu();?>

                </div>
                <div class="col-md-2">
                    <ul class="nav-footer">
                        <li>Ikuti Kami</li>
                        <li><a href="https://www.facebook.com/cilsyfiolution/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/cilsyfiolution/">Instagram</a></li>
                        <li><a href="#">Line</a></li>
                        <li><a href="#">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="nav-footer">
                        <li>Bantuan</li>
                        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                        <li><a href="{{ url('/kebijakan') }}">Kebijakan Layanan</a></li>
                        <li><a href="{{ url('/carapesan') }}">Cara Pesan & Berlangganan</a></li>
                        <li><a href="{{ url('member/package') }}">Harga & Perbandingan Paket</a></li>
                        <li><a href="{{ url('/petunjuk') }}">Petunjuk Pembayaran</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('https://blog.cilsy.id') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="copyrigth-text">
                        Jl. Dr. Djundjunan No 169 RT 002 RW 002 Kel Husein Sastranegara Kec Cicendo Bandung
                    </p>
                </div>
            </div>
        </div>
    </div>
   <script>
            var sidebarBox = document.querySelector('#box'),
                sidebarBtn = document.querySelector('#btn'),
                pageWrapper = document.querySelector('#page-wrapper');

            sidebarBtn.addEventListener('click', function (event) {
                sidebarBtn.classList.toggle('active');
                sidebarBox.classList.toggle('active');
            });

            pageWrapper.addEventListener('click', function (event) {

                if (sidebarBox.classList.contains('active')) {
                    sidebarBtn.classList.remove('active');
                    sidebarBox.classList.remove('active');
                }
            });

            window.addEventListener('keydown', function (event) {

                if (sidebarBox.classList.contains('active') && event.keyCode === 27) {
                    sidebarBtn.classList.remove('active');
                    sidebarBox.classList.remove('active');
                }
            });
          </script>
 <script type="text/javascript">
    // $("#close").ready(function(){
    //   $("#top-section").css("margin-top", "76px")
    // })
    $(document).ready(function() {
      var btncategory = $('.btn-category').width();
      $('.dropdown-item').css('width',btncategory);
    });
    </script>
    <script type="text/javascript">
      function changeCategory(category) {
        $('.cate_title').text(category);
        if (category == 'Semua Kategori') {
            $('.searchcategory').val('');
        }else {
            $('.searchcategory').val(category);
        }
      }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

    <script>
      $(document).ready(function() {
  $('.menu-icon').click(function(event){
    $('#sidebar').toggleClass('sidebar-expand');
    console.log('clicked');
  });
  $('#sidebar ul li').click(function(event) {
    $('#sidebar ul li').removeClass('icon-active')
    $(this).addClass('icon-active')
  });
  $('.header-menu .has-dropdown').on('click', function(event) {
    var _this = $(this).children('.dropdown-container');
    if (_this.css('display').toLowerCase() !== 'block') {
      $('.header-menu .dropdown-container').hide()
      _this.show()
    } else {
      _this.hide()
    }
  });
  $(document).click(function(){
    $('.dropdown-container').hide();
    $('#sidebar').removeClass('sidebar-expand');
  });
  $('.header-menu .has-dropdown, #sidebar').click(function(e){
    e.stopPropagation();
  });
});
    </script>
    <!-- Search Form Auto complete -->
    <script type="text/javascript">
    $(function() {
      $(".keyword").autocomplete({
        source:'{{ url("search/autocomplete")}}',
        select:function(event,ui) {
          $(".keyword").val(ui.item.label);
          return false;
        },
        minLength: 1,
      }).bind('focus', function () {
        $('.ui-autocomplete').css('z-index','9999').css('overflow-y','scroll').css('max-height','300px');
        // $('.ui-autocomplete').css('background','#09121a').css('color','#fff');
        // $('.ui-menu .ui-menu-item-wrapper').css('padding','11px 1em 3px 1.4em !important');
        $(this).autocomplete("search");
        // var btncategory = $('.btn-category').width();
        // var left = '-'+btncategory+'px';
      });
    });
    </script>
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
    <script>
// Set the date we're counting down to
    var countDownDate = new Date("Feb 10, 2018 23:59:59").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get todays date and time
        var now = new Date().getTime();
        
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days 
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script>

    <!-- <script type="text/javascript">
      function notifview(id){
        var token   = "{{csrf_token()}}";
        var dataString= '_token='+ token + '&id=' + id ;
         $.ajax({
          type:"GET",
          url:"{{url('ajax/notif/view')}}",
          data:dataString,
          success:function(data){
          }
        });
      }
    </script> -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-101007788-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="{{asset('template/web/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/web/js/pace.js') }}"></script>

    <!-- rating -->
    <script src="{{ asset('template/web/js/star-rating.min.js') }}"></script>
    <!-- rating -->
    <!-- Custom Js -->
    <script type="text/javascript" src="{{asset('template/web/js/custom.js') }}"></script>
    @stack('js')
</body>

</html>