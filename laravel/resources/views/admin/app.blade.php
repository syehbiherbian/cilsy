<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Cilsy Administrator</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('template/admin/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('template/admin/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('template/admin/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('template/admin/plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('template/admin/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('template/admin/css/themes/all-themes.css')}}" rel="stylesheet" />

    <!-- File Manager -->
    <link href="{{ asset('assets/fancybox/jquery.fancybox.css') }}" rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="{{asset('template/admin/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
    <script src="{{asset('template/admin/plugins/jquery/jquery.min.js')}}"></script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Cilsy Administrator</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>-->
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" onclick="$('#form-logout').submit();">Logout</a></li>
                    <form id="form-logout" action="{{url('/logout')}}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    {{--<img src="images/user.png" width="48" height="48" alt="User" />--}}
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email}}</div>
                    <!-- <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);" onclick="$('#form-logout').submit();"><i class="material-icons">input</i>Sign Out</a></li>



                        </ul>
                    </div> -->
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{url('/system/dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/lessons') }}">
                            <i class="material-icons">file_upload</i>
                            <span>Lessons</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/files') }}">
                            <i class="material-icons">file_upload</i>
                            <span>Files</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/members') }}">
                            <i class="material-icons">account_box</i>
                            <span>Members</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/videos') }}">
                            <i class="material-icons">file_upload</i>
                            <span>Videos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{action('KategoriController@index')}}">
                            <i class="material-icons">assignment</i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/income') }}">
                            <i class="material-icons">assignment</i>
                            <span>Income</span>
                        </a>
                    </li>
                    <li>
                         <a href="{{ url('system/reward-category') }}">
                             <i class="material-icons">assignment</i>
                             <span>Reward Category</span>
                         </a>
                     </li>
					         <li>
                        <a href="{{ url('system/reward') }}">
                            <i class="material-icons">assignment</i>
                            <span>Reward</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('system/pages') }}">
                            <i class="material-icons">assignment</i>
                            <span>Pages</span>
                        </a>
                    </li>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">&copy Cilsy Fiolution</a>.
                </div>
                <!-- <div class="version">
                    <b>Version: </b> 1.0.4
                </div> -->
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    @yield('content')
        <!-- Jquery Core Js -->


    <!-- Bootstrap Core Js -->
    <script src="{{asset('template/admin/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('template/admin/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('template/admin/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('template/admin/plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('template/admin/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('template/admin/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('template/admin/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <!-- {{--<script src="{{asset('template/admin/plugins/flot-charts/jquery.flot.js')}}"></script>--}}
    {{--<script src="{{asset('template/admin/plugins/flot-charts/jquery.flot.resize.js')}}"></script>--}}
    {{--<script src="{{asset('template/admin/plugins/flot-charts/jquery.flot.pie.js')}}"></script>--}}
    {{--<script src="{{asset('template/admin/plugins/flot-charts/jquery.flot.categories.js')}}"></script>--}}
    {{--<script src="{{asset('template/admin/plugins/flot-charts/jquery.flot.time.js')}}"></script>--}} -->

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('template/admin/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
    <!-- Jquery DataTable Plugin Js -->
    <!-- <script src="{{asset('template/admin/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script> -->

    <!-- Custom Js -->
    <!-- <script src="{{asset('template/admin/js/pages/tables/jquery-datatable.js')}}"></script> -->
    <!-- Custom Js -->
    <script src="{{asset('template/admin/js/admin.js')}}"></script>
    <!-- <script src="{{asset('template/admin/js/pages/index.js')}}"></script>
    <script src="{{asset('template/admin/js/pages/examples/sign-in.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{asset('template/admin/js/demo.js')}}"></script>

    <!-- Filemanager -->
    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/fancybox/jquery.fancybox.js') }}"></script>
    <script>
      $('.iframe-btn').fancybox({
       'width'     : 900,
       'height'    : 600,
       'type'      : 'iframe',
       'autoScale' : false
      });
      function responsive_filemanager_callback(field_id){
        console.log(field_id);
        var image = $('#' + field_id).val();
        $('#'+"prev"+field_id).attr('src', image);
        $('#fancybox-wrap').hide(750);
        $('#fancybox-overlay').hide(750);
      };
    </script>
    <script>
    tinymce.init({
      selector: "textarea",theme: "modern",width: '100%',height: 300,
      plugins: [
           "advlist autolink link image lists charmap print preview hr anchor pagebreak",
           "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
           "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
     ],
     toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
     toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
     image_advtab: true ,

     external_filemanager_path:"{{ asset('/assets/filemanager')}}/",
     filemanager_title:"Responsive Filemanager" ,
     external_plugins: { "filemanager" : "{{ asset('/assets/filemanager/plugin.min.js') }}"}
   });
   </script>
</body>

</html>
