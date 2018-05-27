<!Doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>:: Gafista Admin ::</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/>
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
    <script type="text/javascript" src="assets/js/pages/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/admin-index.js"></script>
    <script type="text/javascript" src="assets/js/pages/admin-notifications.js"></script>
</head>
<body class="theme-orange">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">        
        <div class="line"></div>
		<div class="line"></div>
		<div class="line"></div>
        <p>Please wait...</p>
        <div class="m-t-30"><img src="assets/images/logop.png" width="48" height="48" alt="Gafista"></div>
    </div>
</div>
<!-- Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html">Gafista</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
                <div class="notify"><span class=""></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu slideDown">
                    <li class="header">NOTIFICATIONS</li>
                    <li class="body">
                        <ul class="menu list-unstyled" id="notify">
                        </ul>
                    </li>
                    <li class="footer"> <a href="display_notifications.html">View All Notifications</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true">
                    <i class="zmdi zmdi-fullscreen"></i>                   
                </a>
            </li>
            <li><a href="#" class="mega-menu" data-close="true" id="logout"><i class="zmdi zmdi-power"></i></a></li>
        </ul>
    </div>
</nav>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="assets/images/xs/avatar1.jpg" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" id="username">John Doe</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu slideUp">
                    <li><a href="profile.html"><i class="material-icons">person</i>Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="sign-in.html"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="email" id="useremail">john.doe@example.com</div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active"> <a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>

            </li>

            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shopping-cart"></i><span>Ticket</span> </a>
                <ul class="ml-menu">

                    <li> <a href="vticket.html">View Ticket</a></li>
                    <li><a href="ticket_timeline.html">Tickect Timeline</a></li>

                </ul>
            </li>
            <li> <a href="pickup.html" class="menu-toggle"><i class="zmdi zmdi-car"></i><span>Assign Pick-Ups</span> </a></li>

            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Property</span> </a>
                <ul class="ml-menu">
                    <li> <a href="vproperty.html">View Property</a></li>
                    <li> <a href="add_property.html">Add Property</a></li>
                    <li> <a href="add_property_grp.html">Add Property Group</a></li>
                    <li> <a href="view_property_grp.html">View Property Groups</a></li>
                </ul>
            </li>
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Users/Admins</span> </a>
                <ul class="ml-menu">
                    <li><a href="contact.html">View Clients</a></li>
                    <li><a href="create_user.html">Create Clients</a> </li>
                    <li><a href="contact_admin.html">View Admins</a></li>
                    <li><a href="create_agent.html">Create Admins</a></li>
                    <li><a href="view_drivers.html">View Drivers</a></li>
                    <li><a href="create_driver.html">Create Drivers</a> </li>
                    <!--<li><a href="form-upload.html">File Upload</a></li>-->
                </ul>
            </li>
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-grid"></i><span>Reports</span> </a>
                <ul class="ml-menu">
                    <li> <a href="vreport.html">View Report</a> </li>

                </ul>
            </li>

            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-money"></i><span>Payments</span> </a>
                <ul class="ml-menu">

                    <li><a href="wallet.html">Wallet</a></li>
                    <li><a href="billing.html">Billing</a></li>

                </ul>
            </li>

            <li> <a href="alltransaction.php" class="menu-toggle"><i class="zmdi zmdi-book"></i><span>All Transactions</span> </a>
            <li> <a href="requery.php" class="menu-toggle"><i class="zmdi zmdi-refresh"></i><span>Requery Pending Transactions</span> </a>





        </ul>
    </div>
    <!-- #Menu -->
</aside>
<div class="chat-launcher"></div>
<div class="chat-wrapper">
    <div class="card">
        <div class="header">
            <h2>TL Groups</h2>                    
        </div>
        <div class="body">
            <div class="chat-widget">
            <ul class="chat-scroll-list clearfix">
                <li class="left float-left">
                    <img src="assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">
                    <div class="chat-info">
                        <a class="name" href="index.html#">Alexander</a>
                        <span class="datetime">6:12</span>                            
                        <span class="message">Hello, John </span>
                    </div>
                </li>
                <li class="right">
                    <div class="chat-info"><span class="datetime">6:15</span> <span class="message">Hi, Alexander<br> How are you!</span> </div>
                </li>
                <li class="right">
                    <div class="chat-info"><span class="datetime">6:16</span> <span class="message">There are many variations of passages of Lorem Ipsum available</span> </div>
                </li>
                <li class="left float-left"> <img src="assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                    <div class="chat-info"> <a class="name" href="index.html#">Elizabeth</a> <span class="datetime">6:25</span> <span class="message">Hi, Alexander,<br> John <br> What are you doing?</span> </div>
                </li>
                <li class="left float-left"> <img src="assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                    <div class="chat-info"> <a class="name" href="index.html#">Michael</a> <span class="datetime">6:28</span> <span class="message">I would love to join the team.</span> </div>
                </li>
                    <li class="right">
                    <div class="chat-info"><span class="datetime">7:02</span> <span class="message">Hello, <br>Michael</span> </div>
                </li>
            </ul>
            </div>
            <div class="input-group">
                <div class="form-line">
                    <input type="text" class="form-control date" placeholder="Enter your email...">
                </div>
                <span class="input-group-addon"> <i class="material-icons">send</i> </span>
            </div>
        </div>
    </div>
</div>
<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>All Transaction Details TABLE 
                <small class="text-muted">Welcome to Gafista</small>
                </h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        <table id= "transactions" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Transaction_Id</th>
                                <th>Amount</th>
                                <th>responseType</th>
                                <th>description</th>
                                <th>date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Transaction_Id</th>
                                    <th>Amount</th>
                                    <th>responseType</th>
                                    <th>description</th>
                                    <th>date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $('#transactions').DataTable({
            "columns": [
                {"data": "Name"},
                {"data": "Transaction_Id"},
                {"data": "Amount"},
                {"data": "responseType"},
                {"data": "description"},
                {"data": "Date"}
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: 'fetchalltransaction.php',
                type: 'POST'
            },
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
</body>
</html>