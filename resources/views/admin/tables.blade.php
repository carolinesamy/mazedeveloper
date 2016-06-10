<!DOCTYPE html>
<html lang="en">
<style>
    .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
        text-align: center;
        -webkit-box-shadow: 0px 3px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow:    0px 3px 0px rgba(0, 0, 0, 0.3);
        box-shadow:         0px 3px 0px rgba(0, 0, 0, 0.3);
    }
</style>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin.css" rel="stylesheet">

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

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin/aindex">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="/admin/aindex"><i class="fa fa-fw fa-dashboard"></i> Test</a>
                    </li>
                    <li>
                        <a href="/admin/charts"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="/admin/tables"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="/admin/forms"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="/admin/bootstrapElements"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="/admin/bootstrapGrid"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/blankPage"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="/admin/rindex"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
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
                            Tables
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

                <div class="row">
                    <div class="col-md-12">
                        <h2>Students</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/student/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Full Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Points
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->sfull_name }}</td>
                                        <td>{{$student->email }}</td>
                                        <td>{{$student->points }}</td>
                                        <td>
                                            {{ Form::open(['route' => ['admin.student.destroy', $student->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/student/{{$student->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/student/{{$student->id}}/edit">Edit</a>
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2>Instructors</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right"  href="/admin/instructor/create" ><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Full Name
                                    </th>
                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        points
                                    </th>
                                    <th>
                                        type
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($instructors as $instructor)
                                    <tr>
                                        <td>{{$instructor->ifull_name }}</td>
                                        <td>{{$instructor->email }}</td>
                                        <td>{{$instructor->points }}</td>
                                        <td>{{$instructor->type }}</td>

                                        <td>
                                            {{ Form::open(['route' => ['admin.instructor.destroy', $instructor->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/instructor/{{$instructor->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/instructor/{{$instructor->id}}/edit">Edit</a>
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <h2>Courses</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/course/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Course Name
                                    </th>
                                    <th>
                                        maximum points
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$course->max_points}}</td>

                                        <td>
                                            {{ Form::open(['route' => ['admin.course.destroy', $course->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/course/{{$course->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/course/{{$course->id}}/edit">Edit</a>
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Categories</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/category/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Category Name
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->category_name}}</td>


                                        <td>
                                            {{ Form::open(['route' => ['admin.category.destroy', $category->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/category/{{$category->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/category/{{$category->id}}/edit">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Intakes</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/intake/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Intake Number
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($intakes as $intake)
                                    <tr>
                                        <td>{{$intake->intake_number}}</td>


                                        <td>
                                            {{ Form::open(['route' => ['admin.intake.destroy', $intake->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/intake/{{$intake->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/intake/{{$intake->id}}/edit">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <h2>Tags</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/tag/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Tag Name
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{$tag->tag_name}}</td>


                                        <td>
                                            {{ Form::open(['route' => ['admin.tag.destroy', $tag->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/tag/{{$tag->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/tag/{{$tag->id}}/edit">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Tracks</h2>
                        <div class="table-responsive">
                            <a class="btn btn-success btn-circle btn-lg pull-right" href="/admin/track/create"><span class="glyphicon glyphicon-plus" style="font-size: 30px"></span></a>


                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Track Name
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tracks as $track)
                                    <tr>
                                        <td>{{$track->track_name}}</td>


                                        <td>
                                            {{ Form::open(['route' => ['admin.track.destroy', $track->id], 'method' => 'delete']) }}
                                            <a class="btn btn-primary" href="/admin/track/{{$track->id}}">Show</a>
                                            <a class="btn btn-warning" href="/admin/track/{{$track->id}}/edit">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
