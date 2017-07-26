<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IE=edge"" "/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <title>Cilsy Fiolution | Contributor</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('template/kontributor/img/logo-only.png')}}"/>
    <link href="{{asset('template/kontributor/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/kontributor/css/custom.css')}}" rel="stylesheet">
</head>

<body>
    <div id="header">
        <div class="container">
            <img src="{{asset('template/kontributor/img/logo.png')}}" class="logo" alt="">

            <div class="header-menu">
                <ul>
                    <li>
                        <span class="hello-user">Halo Rizal</span>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Notifikasi.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                                <li>
                                    <a href="#">
                                        Notifikasi 1
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Notifikasi 2
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Notifikasi 3
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Notifikasi 4
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="has-dropdown">
                        <img src="{{asset('template/kontributor/img/icon/Akun.png')}}" alt="">
                        <div class="dropdown-container">
                            <ul>
                                <li>
                                    <a href="#">
                                        Profesional Kontributor
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        7000 Pts
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
    <div id="navigation">
        <ul class="breadcrumb">
            <li>Dashboard</li>
            <li>Sub Menu</li>
            <li>Sub Sub Menu</li>
            <li>Sub Sub Sub Menu</li>
        </ul>
    </div>

    <div id="sidebar">
        <div class="menu-wrapper">
            <a href="#" class="menu-icon">
                <img src="{{asset('template/kontributor/img/icon/Menu.png')}}" alt="" />
            </a>
        </div>

        <ul>
            <li>
                <a href="#">
                    <img src="{{asset('template/kontributor/img/icon/Home.png')}}" alt="" />
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Pendapatan.png')}}" alt="" />
                    <span>Kelola Pendapatan</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Tutorial</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="{{asset('template/kontributor/img/icon/Kelola_Tutorial.png')}}" alt="" />
                    <span>Kelola Pertanyaan</span>
                </a>
            </li>
            <li>
                <a href="#">
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

    <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/kontributor/js/custom.js')}}"></script>
</body>

</html>
