<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <link href="{{asset('template/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('template/web/css/pace.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/assets/owl.carousel.css')}}">
    <script type="text/javascript" src="{{asset('template/web/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/web/plugins/OwlCarousel2-2.2.1/dist/owl.carousel.js') }}"></script>
<!-- start Mixpanel --><script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
mixpanel.init("b208ef84bd5045e39433ef24aa0b823c");</script><!-- end Mixpanel -->
    <style media="screen">

    .loading{
        position: fixed;
        background: #2BA8E2;
        left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
        z-index: 999;
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
    </style>
</head>

<body>
    <div class="loading">
        &nbsp;
        <div class="middle">
            <div class="middle-item">
                <img src="{{asset('template/web/img/logo.png')}}" alt="cilsy" class="logo">
            </div>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <a href="{{ url('/') }}">
                <img class="logo" src="{{asset('template/web/img/logo.png')}}"></img>
            </a>
            <a href="{{ url('lessons/browse/all') }}" class="browse-btn">Browse Tutorial</a>
            <div class="header-left pull-right">
              <?php if (!empty(Session::get('memberID'))){ ?>
                <a href="#" class="masuk-btn">Halo, <?= Helper::member('username'); ?></a>
                <div class="drop-down">
                  <a href="#" style="color:#FFF" class="user-arrow">&#x25BE;</a>
                  <div class="drop-down-content">
                    <table cellpadding="15">
                      <tr>
                        <td>Status Paket</td>
                        <td>: <?= Helper::package('title'); ?></td>
                      </tr>
                      <tr>
                        <td>Masa Aktif</td>
                        <td>: <?= Helper::package('expired'); ?> hari</td>
                      </tr>
                      <tr>
                        <td><a href="{{ url('member/package') }}" class="btn btn-danger btn-package">Perpanjang</a></td>
                        <td><a href="{{ url('member/change') }}" class="btn btn-success">Ganti Password</a></td>
                        <td><a href="{{ url('member/signout') }}" class="btn btn-primary btn-signout">Logout</a></td>
                      </tr>
                    </table>
                  </div>
                </div>

              <?php }else{ ?>
                <a href="{{ url('member/signin') }}" class="masuk-btn">Masuk</a>
                <a href="{{ url('member/signup')}}" class="daftar-header-btn">Daftar</a>
              <?php } ?>
            </div>
        </div>
    </div>
    @yield('content')
        <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="footer-logo" src="{{asset('template/web/img/logo-only.png') }}" alt=""></img>
                    <span class="footer-logo-text">Cilsy</span>
                    <p>
                        Adalah platform tutorial jaringan dan server online yang memudahkan semua
                        orang yang ingin belajar dan berdiskusi dengan ahli.
                    </p>
                    <p class="copyrigth-text">
                        Copyright Cilsy Fiolution 2016-2017
                    </p>
                </div>
                <div class="col-md-2">
                    <ul class="nav-footer">
                        <li>Cilsy</li>
                        <li><a href="{{ url('/tentang') }}">Tentang</a></li>
                        <li><a href="{{ url('pages/blog')}}">Blog</a></li>
                        <li><a href="{{ url('pages/karir')}}">Karir</a></li>
                        <li><a href="{{ url('pages/faq')}}">FAQ</a></li>
                    </ul>
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

    <script type="text/javascript" src="{{asset('template/web/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/web/js/pace.js') }}"></script>
    <script type="text/javascript" src="{{asset('template/web/js/custom.js') }}"></script>
</body>

</html>
