<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Denhthlay Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{url('storage/icons/denhthlay_logo4.jpg')}}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{url('admin/assets/plugins/morris/morris.css')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{url('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{url('admin/assets/css/metisMenu.min.css')}}" rel="stylesheet">
    <!-- Icons CSS -->
    <link href="{{url('admin/assets/css/icons.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{url('admin/assets/css/style.css')}}" rel="stylesheet">


    <!-- DataTables -->
    <link href="{{url('admin/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('admin/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{url('admin/assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <script src="{{url('admin/assets/js/jquery-2.2.1.js')}}"></script>
    <link href="{{url('admin/assets/plugins/summernote/summernote.css')}}" rel="stylesheet" />
    <link href="{{url('admin/assets/plugins/dropzone/dropzone.css')}}" rel="stylesheet" />
    <link href="{{url('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{url('admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('admin/assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <link href="{{url('admin/assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>

    <link href="{{url('admin/assets/css/custom.css')}}" rel="stylesheet">
</head>


<body>

<div id="page-wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- Top navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <!-- Mobile menu button -->
                    <div class="pull-left">
                        <button type="button" class="button-menu-mobile visible-xs visible-sm">
                            <i class="fa fa-bars"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <!-- Top nav Right menu -->
                    <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">

                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="{{url('storage/'.Auth::user()->profile)}}" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">

                                <li><a href="{{url('/system/logout')}}"><i class="ti-power-off m-r-10"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div> <!-- end container -->
        </div> <!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- Page content start -->
    <div class="page-contentbar">