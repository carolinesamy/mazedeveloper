<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Developer Maze</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <a href="/admin/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="/admin/aindex"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="/admin/instructor"><i class="fa fa-fw fa-bar-chart-o"></i> Instructors</a>
                </li>
                <li>
                    <a href="/admin/tables"><i class="fa fa-fw fa-table"></i> Students</a>
                </li>
                <li>
                    <a href="/admin/course"><i class="fa fa-fw fa-edit"></i> Courses</a>
                </li>
                <li>
                    <a href="/admin/category"><i class="fa fa-fw fa-desktop"></i> Categories</a>
                </li>
                <li>
                    <a href="/admin/intake"><i class="fa fa-fw fa-wrench"></i> Intake</a>
                </li>

                <li>
                    <a href="/admin/tag"><i class="fa fa-fw fa-file"></i> Tags</a>
                </li>
                <li>
                    <a href="/admin/track"><i class="fa fa-fw fa-dashboard"></i> Tracks</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        {{$title}}
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="/admin/aindex">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Tables
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            @yield('content')
        </div>
    </div>

</div>
<footer>
    <hr>
    <p>Copy Rights AMC2 </p>
</footer>
<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
