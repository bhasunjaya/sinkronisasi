<!DOCTYPE html>
<html>

<head>
    {{-- http://pages.revox.io/dashboard/latest/html/widget.html --}}

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />

    <title>Pages - Admin Dashboard UI Kit - Blank Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('b3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{asset('b3/css/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('b3/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" /> {{--
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" /> --}} {{--
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" /> --}}
    <link href="{{asset('b3/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{asset('b3/css/pages.css')}}" rel="stylesheet" type="text/css" /> @stack('styles')

    <!--[if lte IE 9]>
    <link href="assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
</head>

<body class="fixed-header ">
    <nav class="page-sidebar" data-pages="sidebar">
        <div class="sidebar-header">
            <img src="{{asset('b3/img/logo_white.png')}}" alt="logo" class="brand" data-src="{{asset('b3/img/logo_white.png')}}" data-src-retina="{{asset('b3/img/logo_white_2x.png')}}" width="78" height="22">
            <div class="sidebar-header-controls">
                <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu">
                    <i class="fa fa-angle-down fs-16"></i></button>
                <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu-items">
                <li class="m-t-30 ">
                    <a href="index.html" class="detailed">
                        <span class="title">Dashboard</span>
                        <span class="details">12 New Updates</span>
                    </a>
                    <span class="bg-success icon-thumbnail"><i class="pg-home"></i></span>
                </li>
                <li>
                    <a href="javascript:;" class="detailed">
                        <span class="title">Master Data</span>
                        <span class="details">inisialisasi</span>
                    </a>
                    <span class="icon-thumbnail">M</span>
                    <ul class="sub-menu">
                        <li class="">
                            <a href="{{url('/')}}">Bidang DAK</a>
                            <span class="icon-thumbnail">dak</span>
                        </li>
                        <li class="">
                            <a href="{{url('/')}}">Pemda</a>
                            <span class="icon-thumbnail">p</span>
                        </li>
                        <li class="">
                            <a href="{{url('/')}}">Bappenas</a>
                            <span class="icon-thumbnail">b</span>
                        </li>
                        <li class="">
                            <a href="{{url('/')}}">K/L Teknis</a>
                            <span class="icon-thumbnail">kl</span>
                        </li>
                        <li class="">
                            <a href="{{url('/')}}">Dinas</a>
                            <span class="icon-thumbnail">kl</span>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{url('djpk/user')}}" class="detailed">
                        <span class="title">Users</span>
                        <span class="details">database</span>
                    </a>
                    <span class="icon-thumbnail"><i class="fa fa-users"></i></span>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </nav>
    <div class="page-container ">
        <div class="header ">
            <div class="container-fluid relative">
                <div class="pull-left full-height visible-sm visible-xs">
                    <div class="header-inner">
                        <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
                            <span class="icon-set menu-hambuger"></span>
                        </a>
                    </div>
                </div>
                <div class="pull-center hidden-md hidden-lg">
                    <div class="header-inner">
                        <div class="brand inline">
                            <img src="{{asset('b3/img/logo.png')}}" alt="logo" data-src="{{asset('b3/img/logo.png')}}" data-src-retina="{{asset('b3/img/logo_2x.png')}}" width="78" height="22">
                        </div>
                    </div>
                </div>
                <div class="pull-right full-height visible-sm visible-xs">
                    <div class="header-inner">
                        <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
                            <span class="icon-set menu-hambuger-plus"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class=" pull-left sm-table hidden-xs hidden-sm">
                <div class="header-inner">
                    <div class="brand inline">
                        <img src="{{asset('b3/img/logo.png')}}" alt="logo" data-src="{{asset('b3/img/logo.png')}}" data-src-retina="{{asset('b3/img/logo_2x.png')}}" width="78" height="22">
                    </div>
                </div>
            </div>
            <div class=" pull-right">
                <div class="visible-lg visible-md m-t-10">
                    <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                        <span class="semi-bold">David</span> <span class="text-master">Nest</span>
                    </div>
                    <div class="dropdown pull-right">
                        <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="thumbnail-wrapper d32 circular inline m-t-5">
                                <img src="{{asset('b3/img/avatar.jpg')}}" alt="" data-src="{{asset('b3/img/avatar.jpg')}}" data-src-retina="{{asset('b3/img/avatar.jpg')}}" width="32" height="32">
                            </span>
                        </button>
                        <ul class="dropdown-menu profile-dropdown" role="menu">
                            <li><a href="#"><i class="pg-settings_small"></i> Settings</a>
                            </li>
                            <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
                            </li>
                            <li><a href="#"><i class="pg-signals"></i> Help</a>
                            </li>
                            <li class="bg-master-lighter">
                                <a href="#" class="clearfix">
                                    <span class="pull-left">Logout</span>
                                    <span class="pull-right"><i class="pg-power"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="content ">
                <div class="jumbotron" data-pages="parallax">
                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                            <h1>@yield('pagetitle')</h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid container-fixed-lg">
                    @yield('content')
                </div>
            </div>
            <div class="container-fluid container-fixed-lg footer">
                <div class="copyright sm-text-center">
                    <p class="small no-margin pull-left sm-pull-reset">
                        <span class="hint-text">Copyright &copy; 2014 </span>
                        <span class="font-montserrat">REVOX</span>.
                        <span class="hint-text">All rights reserved. </span>
                        <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
                    </p>
                    <p class="small no-margin pull-right sm-pull-reset">
                        <a href="#">Hand-crafted</a> <span class="hint-text">&amp; Made with Love ®</span>
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-labelledby="modalSlideUpLabel" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="pg-close fs-14"></i>
                        </button>
                        <h5>Apakah anda Yakin?</h5>
                        <p> Proses ini tidak dapat diulang</p>
                    </div>
                    <div class="modal-body  text-center">
                        <button type="button" class="btn btn-primary" data-url="" id="confirm-yes">YA</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script> --}}
    <script src="{{asset('b3/js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('b3/js/modernizr.custom.js')}}" type="text/javascript"></script>
    {{--
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script> --}}
    <script src="{{asset('b3/js/bootstrap.min.js')}}" type="text/javascript"></script>
    {{--
    <script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script> --}} {{--
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> --}} {{--
    <script src="assets/plugins/jquery-bez/jquery.bez.min.js"></script> --}} {{--
    <script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script> --}} {{--
    <script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script> --}}
    <script src="{{asset('b3/js/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
    {{--
    <script type="text/javascript" src="assets/plugins/select2/js/select2.full.min.js"></script> --}} {{--
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script> --}} {{--
    <script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script> --}}
    <script src="{{asset('b3/js/pages.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('b3/js/scripts.js')}}" type="text/javascript"></script>

    @stack('scripts') {{--
    <script src="assets/js/demo.js" type="text/javascript"></script> --}}
</body>

</html>
