<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Cilsy Fiolution | Contributor</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('template/kontributor/img/logo-only.png')}}"/>
    <link href="{{asset('template/kontributor/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/sweetalert.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
</head>

<body>
    <div id="header">
        <div class="container">
            <img src="{{asset('template/kontributor/img/logo.png')}}" class="logo" alt="">

            <div class="header-menu">
                <ul>
                    <li>
                        <span class="hello-user">Halo Syehbi</span>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                              <?php echo notif();?>
                            </ul>
                        </div>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Akun.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                                <li>
                                    <a href="#">
                                        <?php echo badge();?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        {{points()}} Pts
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Panduan Kontributor
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @yield('breadcumbs')


    <div id="sidebar">
        <div class="menu-wrapper">
            <a href="#" class="menu-icon">
                <img src="{{asset('template/kontributor/img/icon/Menu.png')}}" alt="" />
            </a>
        </div>

        <ul>

            <li class="icon-active">
                    <a href="{{ url('contributor/dashboard') }}">
                    <img src="{{asset('template/kontributor/img/icon/Home.png')}}" alt="" />
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{url('contributor/income')}}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Pendapatan.png')}}" alt="" />
                    <span>Kelola Pendapatan</span>
                </a>
            </li>
            <li>
                <a href="{{ url('contributor/lessons') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Tutorial</span>
                </a>
            </li>
            <li>
                <a href="{{ url('contributor/coments') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Pertanyaan</span>
                </a>
            </li>
            <li>
                <a href="{{ url('contributor/account/informasi') }}">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Akun_dan_Halaman.png')}}" alt="" />
                    <span>Kelola Akun dan Halaman</span>
                </a>
            </li>
        </ul>
    </div>

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <img class="footer-logo" src="{{asset('template/kontributor/img/logo-only.png')}}" alt=""></img>
                    <span class="footer-logo-text">Cilsy</span>
                    <p>
                        Adalah platform tutorial jaringan dan server online yang memudahkan semua
                        orang yang ingin belajar dan berdiskusi dengan ahli.
                    </p>
                    <p class="copyrigth-text">
                        Copyright Cilsy Fiolution 2016-2017
                    </p>
                </div>
                <div class="col-md-2 col-xs-4">
                    <ul class="nav-footer">
                        <li>Cilsy</li>
                        <li><a href="#">Tentang</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-xs-4">
                    <ul class="nav-footer">
                        <li>Ikuti Kami</li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Line</a></li>
                        <li><a href="#">Google+</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-xs-4">
                    <ul class="nav-footer">
                        <li>Bantuan</li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">Kebijakan Layanan</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <p class="copyrigth-text">
                        Sarijadi Blok 23, No. 80, Kota Bandung
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/sweetalert.min.js')}}"></script>
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
</body>

</html>
