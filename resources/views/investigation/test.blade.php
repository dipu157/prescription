
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr">

    <title>Arrora</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/admin/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/admin/vendor/bootstrap/bootstrap4-glyphicons/css/bootstrap-glyphicons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/admin/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/admin/vendor/toastr/toastr.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="/admin/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="/admin/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="/admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">

    <link rel="stylesheet" href="/admin/vendor/fileinput/css/fileinput.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">

    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/admin/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <script type="text/javascript">
        window.Laravel = {"csrfToken":"ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr"};
        var CSRF_TOKEN = 'ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr';
    </script>
</head>

<body>
<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="/admin/img/avatar-1.jpg" alt="person" class="img-fluid rounded-circle">
                <h2 class="h5">admin</h2><span>Admin</span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">

                <li><a href="#products" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Products</a>
                    <ul id="products" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/product" aria-expanded="false">Products list</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/product/create"  aria-expanded="false">Add Products</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/product/barcode"  aria-expanded="false">Print barcode/label</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/product/quantity/lists"  aria-expanded="false">Quantity adjustment</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/product/quantity/create"  aria-expanded="false">Add Products in Warehouse</a></li>

                        <!-- <li><a href="#">Stock count</a></li>
                        <li><a href="#">Count stock</a></li> -->
                    </ul>
                </li>
                <li><a href="#sales" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Sales</a>
                    <ul id="sales" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/sales" aria-expanded="false">Sales Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/sales/create"  aria-expanded="false">Add Sales</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/sales/deliveries"  aria-expanded="false">Deliveries</a></li>

                    </ul>
                </li>
                <li><a href="#purchase" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Purchase</a>
                    <ul id="purchase" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/purchase" aria-expanded="false">Purchase Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/purchase/create"  aria-expanded="false">Add Purchase</a></li>

                    </ul>
                </li>
                <li><a href="#expanse" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Expanse</a>
                    <ul id="expanse" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/expanse" aria-expanded="false">Expanse Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/expanse/create"  aria-expanded="false">Add Expanse</a></li>

                    </ul>
                </li>
                <li><a href="#transfer" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Transfers</a>
                    <ul id="transfer" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/transfer" aria-expanded="false">Transfers Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/transfer/create"  aria-expanded="false">Add Transfers</a></li>

                    </ul>
                </li>
                <li><a href="#customer" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Customers</a>
                    <ul id="customer" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/customer" aria-expanded="false">Customers Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/customer/create"  aria-expanded="false">Add Customers</a></li>

                    </ul>
                </li>
                <li><a href="#supplier" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Suppliers</a>
                    <ul id="supplier" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/supplier" aria-expanded="false">Suppliers Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/supplier/create"  aria-expanded="false">Add Suppliers</a></li>

                    </ul>
                </li>
                <li><a href="#profit" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Profits</a>
                    <ul id="profit" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/profit/products" aria-expanded="false">From Products</a></li>
                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/profit/others" aria-expanded="false">From Others</a></li>
                    </ul>
                </li>
                <li><a href="#user" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Users</a>
                    <ul id="user" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/user" aria-expanded="false">Users Lists</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/user/create" aria-expanded="false">Add User</a></li>

                    </ul>
                </li>
                <li><a href="#settings" aria-expanded="false" data-toggle="collapse"><i class="icon-form"></i>Settingss</a>
                    <ul id="settings" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/system" aria-expanded="false">System Settings</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/category" aria-expanded="false">Category</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/subcategory" aria-expanded="false">Sub Category</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/brand" aria-expanded="false">Brand</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/pdtType" aria-expanded="false">Product Type</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/pdtUnit" aria-expanded="false">Product Unit</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/expanseCategory" aria-expanded="false">Expanse Category</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/settings/customerType" aria-expanded="false">Customer Type</a></li>
                    </ul>
                </li>
                <li><a href="#administrasion" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Addministrasion</a>
                    <ul id="administrasion" class="collapse list-unstyled ">

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/administrasion/role" aria-expanded="false">Roles</a></li>

                        <li><a href="http://shumoninventory.herokuapp.com/en/admin/administrasion/permission/create" aria-expanded="false">Permissions</a></li>

                    </ul>
                </li>
                <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Reports</a></li>


            </ul>
        </div>

    </div>
</nav>
<!-- topbar Navbar -->
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="http://shumoninventory.herokuapp.com/admin/home" class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block"><span>Arrora</span><strong class="text-primary">Managment</strong></div></a></div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Notifications dropdown-->
                        <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification d-flex justify-content-between">
                                            <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                                            <div class="notification-time"><small>4 minutes ago</small></div>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification d-flex justify-content-between">
                                            <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                            <div class="notification-time"><small>4 minutes ago</small></div>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification d-flex justify-content-between">
                                            <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                                            <div class="notification-time"><small>4 minutes ago</small></div>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item">
                                        <div class="notification d-flex justify-content-between">
                                            <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                            <div class="notification-time"><small>10 minutes ago</small></div>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                            </ul>
                        </li>
                        <!-- Messages dropdown-->
                        <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile"> <img src="http://shumoninventory.herokuapp.com/admin/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile"> <img src="http://shumoninventory.herokuapp.com/admin/img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile"> <img src="http://shumoninventory.herokuapp.com/admin/img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages    </strong></a></li>
                            </ul>
                        </li>
                        <!-- Languages dropdown    -->
                        <!-- <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                          <ul aria-labelledby="languages" class="dropdown-menu"> -->


                        <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                            <ul aria-labelledby="languages"     class="dropdown-menu">
                                <li>
                                    <a rel="nofollow" class="dropdown-item" hreflang="en" href="http://shumoninventory.herokuapp.com/en/admin/product/create">
                                        <img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/en_GB.png" alt="English" class="mr-2">
                                        English
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" class="dropdown-item" hreflang="es" href="http://shumoninventory.herokuapp.com/es/admin/product/create">
                                        <img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/es_ES.png" alt="English" class="mr-2">
                                        español
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!-- <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/DE.png" alt="English" class="mr-2"><span>German</span></a></li>
                        <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="http://shumoninventory.herokuapp.com/admin/img/flags/16/FR.png" alt="English" class="mr-2"><span>French                                                         </span></a></li> </ul></li>-->


                        <!-- Log out-->
                        <li class="nav-item">
                            <a href="http://shumoninventory.herokuapp.com/en/admin/logout" class="nav-link logout"
                               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                <span class="d-none d-sm-inline-block">Logout</span>
                                <i class="fa fa-sign-out"></i>
                            </a>

                            <form id="logout-form" action="http://shumoninventory.herokuapp.com/en/admin/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <!-- Coutents Section -->
    <section class="dashboard-counts section-padding">
        <div class="container-fluid">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="http://shumoninventory.herokuapp.com/admin/home">Admin</a></li>
                    <li class="breadcrumb-item"><a href="http://shumoninventory.herokuapp.com/en/admin/product">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>

            <div class="row">

                <!-- Count item widget-->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Product <a href="http://shumoninventory.herokuapp.com/en/admin/product" class="btn btn-info float-right">Product Lists</a></h4>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal" method="post" action="http://shumoninventory.herokuapp.com/en/admin/product" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr">
                                <div class="form-group row">
                                    <label for="product_types_id" class="col-sm-2 form-control-label mt-2">Prpduct Type</label>
                                    <div class="col-sm-4">
                                        <select name="product_types_id" id="product_types_id" class="form-control">
                                            <option value="">Select Product Type</option>
                                            <option value="1" >Type-1</option>
                                            <option value="11" >Type-2</option>
                                            <option value="21" >Type-3</option>

                                        </select>
                                    </div>

                                    <label for="name" class="col-sm-2 form-control-label mt-2">Product Name</label>
                                    <div class="col-sm-4">
                                        <input name="name" value="" type="text" id="name"  placeholder="Product Name" class="form-control form-control-success"><!-- <small class="form-text text-warning">Example help text that remains unchanged.</small> -->
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="pdt_code" class="col-sm-2 form-control-label mt-2">Porduct Code</label>
                                    <div class="col-sm-4">
                                        <input name="pdt_code" value="" id="pdt_code" type="text" placeholder="Porduct Code" class="form-control form-control-success">
                                    </div>

                                    <label for="wight" class="col-sm-2 form-control-label mt-2">Porduct Wight</label>
                                    <div class="col-sm-4">
                                        <input name="wight" value="" id="wight" type="text" placeholder="Product Wight" class="form-control form-control-success">
                                    </div>
                                </div>



                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="barcode" class="col-sm-2 form-control-label mt-2">Barcode</label>
                                    <div class="col-sm-4">
                                        <input name="barcode" value="" id="barcode" type="text" placeholder="Barcode" class="form-control form-control-success">
                                    </div>

                                    <label for="product_brands_id" class="col-sm-2 form-control-label mt-2">Brand</label>
                                    <div class="col-sm-4">
                                        <select name="product_brands_id" id="product_brands_id" class="form-control">
                                            <option value="">Select Brand</option>
                                            <option value="1" >Sumsang</option>
                                            <option value="11" >Hp</option>
                                            <option value="21" >Cisco</option>
                                            <option value="31" >Panasonic</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="product_categories_id" class="col-sm-2 form-control-label mt-2">Category</label>
                                    <div class="col-sm-4">
                                        <select name="product_categories_id" id="product_categories_id" class="form-control select_item"  data-url="http://shumoninventory.herokuapp.com/en/admin/select" data-token="ef3igcIvCbbF4q6oRzhKlwuZCEkOVB8g27R7stbr">
                                            <option value="">Select Category</option>
                                            <option value="1" >Electronics</option>
                                            <option value="11" >Construction</option>
                                            <option value="21" >Cloths</option>
                                            <option value="31" >Housholds</option>
                                        </select>
                                    </div>

                                    <label for="product_subcategories_id" class="col-sm-2 form-control-label mt-2">Sub Category</label>
                                    <div class="col-sm-4">
                                        <div class="get_item">
                                            <select name="product_subcategories_id" id="product_subcategories_id" class="form-control">
                                                <option value="">Select Category First</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="product_units_id" class="col-sm-2 form-control-label mt-2">Product Unit</label>
                                    <div class="col-sm-4">
                                        <select name="product_units_id" id="product_units_id" class="form-control">
                                            <option value="">Select Unit</option>
                                            <option value="1">Piece</option>
                                            <option value="11">Box</option>
                                            <option value="21">Kg</option>
                                            <option value="31">Litter</option>
                                        </select>
                                    </div>

                                    <label for="price" class="col-sm-2 form-control-label mt-2">Product Price</label>
                                    <div class="col-sm-4">
                                        <input name="price" value="" id="price" type="text" placeholder="Product Price" class="form-control form-control-success">
                                    </div>

                                </div>


                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="cost" class="col-sm-2 form-control-label mt-2">Product Cost</label>
                                    <div class="col-sm-4">
                                        <input name="cost" value="" id="cost" type="text" placeholder="Product Wight" class="form-control form-control-success">
                                    </div>

                                    <label for="tax" class="col-sm-2 form-control-label mt-2">Product Tax</label>
                                    <div class="col-sm-4">
                                        <input name="tax" value="" id="tax" type="text" placeholder="Product Tax" class="form-control form-control-success">
                                    </div>
                                </div>


                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="alertQty" class="col-sm-2 form-control-label mt-2">Alert Quantity</label>
                                    <div class="col-sm-4">
                                        <input name="alertQty" value="" id="alertQty" placeholder="Alert Quantity" type="text" class="form-control form-control-success">
                                    </div>


                                    <div class="col-sm-4">
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 form-control-label mt-2">Product Image</label>
                                    <div class="col-sm-4">
                                        <input name="image" value="" id="image" type="file" class="form-control form-control-success">
                                    </div>

                                    <label for="banner" class="col-sm-2 form-control-label mt-2">Banner Image</label>
                                    <div class="col-sm-4">
                                        <input name="banner" id="banner" type="file" class="form-control form-control-success">
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="radioCustom1" class="col-sm-2 form-control-label mt-2">Is Featured</label>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <input id="radioCustom1" type="radio" value="1" name="is_featured" class="form-control-custom radio-custom">
                                            <label for="radioCustom1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <input id="radioCustom2" type="radio" checked="" value="0" name="is_featured" class="form-control-custom radio-custom">
                                            <label for="radioCustom2">No</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 form-control-label mt-2">Status</label>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <input id="status1" type="radio" value="0" checked="" name="status" class="form-control-custom radio-custom">
                                            <label for="status1">Pending</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <input id="status2" type="radio" value="1" name="status" class="form-control-custom radio-custom">
                                            <label for="status2">Publish</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="descp" class="col-sm-2 form-control-label mt-2">Product Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="descp" id="descp" class="summernote form-control form-control-success"></textarea>
                                    </div>
                                </div>

                                <!-- ****************************** -->

                                <div class="form-group row">
                                    <label for="  descp_invoice" class="col-sm-2 form-control-label mt-2">Details (for invoice)</label>
                                    <div class="col-sm-10">
                                        <textarea name="descp_invoice" id=" descp_invoice" class="summernote form-control form-control-success"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Footer -->
    <footer class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <p>Arrora Inventory &copy; 2019</p>
                </div>
                <div class="col-sm-6 text-right">
                    <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
                </div>
            </div>
        </div>
    </footer>

</div>
<!-- JavaScript files-->
<script src="/admin/vendor/jquery/jquery.min.js"></script>
<script src="/admin/vendor/popper.js/umd/popper.min.js"> </script>
<script src="/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/admin/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
<script src="/admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="/admin/vendor/chart.js/Chart.min.js"></script>
<script src="/admin/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/admin/js/charts-home.js"></script>
<script src="/admin/vendor/toastr/toastr.min.js"></script>

<script src="/admin/vendor/fileinput/js/fileinput.min.js"></script>

<!-- include summernote js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
        //bootstrap-fileinput plugin
        $("#image").fileinput({
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

        $("#banner").fileinput({
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif"]
        });


        $('.summernote').summernote({
            placeholder: 'Descriptions',
            tabsize: 2,
            height: 100
        });

    });
</script>

<script src="/admin/js/custom.js"></script>
<!-- Main File-->
<script src="/admin/js/front.js"></script>
</body>
</html>