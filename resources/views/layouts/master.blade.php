<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Online Prescription System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS-->
    <link href="{!! asset('assets/bootstrap-4.1.3/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome CSS-->
    <link href="{!! asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- theme stylesheet-->
    <link href="{!! asset('assets/css/style.default.css') !!}" rel="stylesheet" type="text/css" />
    {{--<link rel="shortcut icon" href="https://d19m59y37dris4.cloudfront.net/admin-premium/1-4-4/img/favicon.ico">--}}

    <link href="{!! asset('assets/css/sweetalert.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/bootstrap-4.0.0/css/bootstrap-imageupload.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/DataTables-1.10.12/css/jquery.dataTables.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/jquery-ui-1.12.1/jquery-ui.css') !!}" rel="stylesheet" type="text/css" />

    <link href="{!! asset('assets/css/mdb.css') !!}" rel="stylesheet" type="text/css" />


    {{--    <script type="text/javascript" src="{!! asset('assets/jquery-ui-1.12.1/jquery-ui.js') !!}"></script>--}}


</head>
<body>

<div class="page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">

            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a href="#" class="navbar-brand d-none d-sm-inline-block">
                            <div class="col-md-4 col-sm-2 col-xs-3">
                                <img src="{!! asset('images/Logobrb.png') !!}" style="height: 50%" class="img-responsive">
                            </div></a>

                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Logout    -->
                        <li class="nav-item">

                            <a class="nav-link logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center"><a href="#">
                    <div class="avatar"><img src="{!! asset('images/male.jpeg') !!}" alt="..." class="img-fluid rounded-circle"></div></a>
                <div class="title">
                    <h1 class="h4">{!! \Illuminate\Support\Facades\Auth::user()->name !!}</h1>
                    <p>IT</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="active"><a href="{!! route('home') !!}"> <i class="icon-home"></i>Home </a></li>


                <li><a class="font-weight-bold" href="#authDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i><strong>AUTH</strong></a>
                    <ul id="authDropdown" class="collapse list-unstyled ">
                        <li><a href="{{ route('register') }}">Add User</a></li>
                        <li><a href="{!! route('privillege/index') !!}">User Privillege</a></li>
                        <li><a href="{!! route('password/reset') !!}">Change Password</a></li>
{{--                        <li><a href="{!! url('authorization/index') !!}">Reset Password</a></li>--}}
                        {{--                        <li><a href="{!! route('deployment/index') !!}">Item Deployment</a></li>--}}

                    </ul>
                </li>

                <li><a class="font-weight-bold" href="#adminDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>ADMIN</a>
                    <ul id="adminDropdown" class="collapse list-unstyled ">
                        <li><a href="{!! route('department/index') !!}">Departments</a></li>
                        <li><a href="{!! route('doctor/index') !!}">Doctors</a></li>
                        {{--<li><a href="{!! route('resource/index') !!}">Add Resource</a></li>--}}
                        <li><a href="#">Add Assistant</a></li>

                    </ul>
                </li>


                <li><a class="font-weight-bold" href="#settingsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>SETTINGS</a>
                    <ul id="settingsDropdown" class="collapse list-unstyled ">
                        <li><a href="{!! route('generic/index') !!}">Add Generic</a></li>
                        <li><a href="{!! route('manufacturer/index') !!}">Add Manufacturer</a></li>
                        <li><a href="{!! route('medicineType/index') !!}">Add Medicine Type</a></li>
                        <li><a href="{!! route('strength/index') !!}">Add Medicine Strength</a></li>
                        <li><a href="{!! route('medicine/index') !!}">Add New Medicine</a></li>
                        <li><a href="{!! route('investigation/index') !!}">Add New Investigation</a></li>

{{--                        <li><a href="{!! route('deployment/shiftindex') !!}">Add Strength</a></li>--}}
{{--                        <li><a href="{!! route('deployment/depreportindex') !!}">Add Time</a></li>--}}
{{--                        <li><a href="{!! route('deployment/depreportindex') !!}">Add Medicine</a></li>--}}

                    </ul>
                </li>




                <li><a class="font-weight-bold" href="#prescriptionDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-padnote"></i>PRESCRIPTION</a>
                    <ul id="prescriptionDropdown" class="collapse list-unstyled ">
                        <li><a href="{!! url('template/index') !!}">Create Template</a></li>
                        <li><a href="{!! route('appointment/index') !!}">Today's Appiontment</a></li>
{{--                        <li><a href="{!! route('requisition/index') !!}">Create Requisition</a></li>--}}
                        {{--<li><a href="#">Create Prescription</a></li>--}}
{{--                        <li><a href="{!! route('requisition/approve') !!}">Approve Requisition</a></li>--}}
                        <li><a href="{!! url('previous/index') !!}">Previous Prescription</a></li>
                    </ul>
                </li>


                <li><a class="font-weight-bold" href="#investigationDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-padnote"></i>INVESTIGATION</a>
                    <ul id="investigationDropdown" class="collapse list-unstyled ">
                        <li><a href="{!! url('investigation/viewIndex') !!}">View Investigation Result</a></li>
                        
                        {{--                        <li><a href="{!! route('requisition/index') !!}">Create Requisition</a></li>--}}
                        {{--<li><a href="#">Create Prescription</a></li>--}}
                        {{--                        <li><a href="{!! route('requisition/approve') !!}">Approve Requisition</a></li>--}}
{{--                        <li><a href="{!! url('previous/index') !!}">Previous Prescription</a></li>--}}
                    </ul>
                </li>



                


                {{--<li><a href="#componentsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-page"></i>Components </a>--}}
                {{--<ul id="componentsDropdown" class="collapse list-unstyled ">--}}
                {{--<li><a href="components-cards.html">Cards</a></li>--}}
                {{--<li><a href="components-calendar.html">Calendar</a></li>--}}
                {{--<li><a href="components-gallery.html">Gallery</a></li>--}}
                {{--<li><a href="components-loading-buttons.html">Loading buttons</a></li>--}}
                {{--<li><a href="components-map.html">Maps</a></li>--}}
                {{--<li><a href="components-notifications.html">Notifications</a></li>--}}
                {{--<li><a href="components-preloader.html">Preloaders</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="#pagesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Pages </a>--}}
                {{--<ul id="pagesDropdown" class="collapse list-unstyled ">--}}
                {{--<li><a href="pages-contacts.html">Contacts</a></li>--}}
                {{--<li><a href="login.html">Login page</a></li>--}}
                {{--<li><a href="pages-profile.html">Profile</a></li>--}}
                {{--<li><a href="pages-pricing.html">Pricing table</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}


            </ul>

        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    @yield('pagetitle')

                </div>
            </header>


            <main class="py-4">
                @include('partials.flash-message')

                @yield('content')
            </main>




            <!-- Page Footer-->
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>BRB Hospitals Ltd &copy; 2014-2019</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Version 1.0.0</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- JavaScript files-->


{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}

{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
<script type="text/javascript" src="{!! asset('assets/bootstrap-4.1.3/js/bootstrap.min.js') !!}"></script>
{{--<!-- Main File-->--}}
<script type="text/javascript" src="{!! asset('assets/js/front.js') !!}"></script>

<script type="text/javascript" src="{!! asset('assets/DataTables-1.10.12/js/jquery.dataTables.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/DataTables-1.10.12/js/dataTables.jqueryui.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/js/bootstrap-imageupload.js') !!}"></script>


{{--<!-- Main File-->--}}

@stack('scripts')

</body>
</html>
