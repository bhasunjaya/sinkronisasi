<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <title>Starter Template for Bootstrap</title>

    <link href="{{asset('flat/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('flat/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <link href="{{asset('flat/css/starter-template.css')}}" rel="stylesheet">
    <link href="{{asset('flat/css/font.css')}}" rel="stylesheet"> @stack('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{url('/')}}">Home</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DJPK <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/djpk/user')}}">User</a></li>
                            <li><a href="{{url('/djpk/bappenas')}}">Bappenas</a></li>
                            <li><a href="{{url('/djpk/bidang')}}">Bidang</a></li>
                            <li><a href="{{url('/djpk/subbidang')}}">Sub-bidang</a></li>
                            <li><a href="{{url('/djpk/dinas')}}">Dinas</a></li>
                            <li><a href="{{url('/djpk/kl')}}">K/L Teknis</a></li>
                            <li><a href="{{url('/djpk/pemda')}}">Subbidang</a></li>
                            <li><a href="{{url('/djpk/kegiatan')}}">Kegiatan</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/djpk/document')}}">Upload</a></li>
                        </ul>
                    </li>
                    <!-- end djpk -->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pemda <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/pemda/entry')}}">Entry Data</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/pemda/review')}}">Review Data Usulan</a></li>
                        </ul>
                    </li>
                    <!-- end djpk -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">K/L <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/kl/kldata')}}">Entry Data</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/kl/review')}}">Review Data Usulan</a></li>
                        </ul>
                    </li>
                    <!-- end djpk -->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bappenas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/bappenas/verifikasi')}}">Verifikasi Usulan</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{Auth::user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/password')}}">Rubah Password</a></li>
                            <li><a href="{{url('/password')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div id="app" class="container">
        @yield('pagetitle')
        <!-- -->
        @yield('content')

    </div>
    <!-- /.container -->

    <script src="{{asset('flat/js/jquery.min.js')}}"></script>
    <script src="{{asset('flat/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('flat/js/ie10-viewport-bug-workaround.js')}}"></script>

    @stack('scripts')

</body>

</html>
