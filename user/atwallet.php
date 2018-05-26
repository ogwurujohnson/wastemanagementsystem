<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>::Gafista User::</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css"/>
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/hm-style.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
    <script type="text/javascript" src="assets/js/pages/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/user-wallet.js"></script>

</head>

<body class="theme-cyan index2">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-cyan">
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

<!-- Overlay For Sidebars -->
<div class="overlay"></div><!-- Search  -->
<div class="search-bar">
    <div class="search-icon"> <i class="material-icons">search</i> </div>
    <input type="text" placeholder="Explore Gafista...">
    <div class="close-search"> <i class="material-icons">close</i> </div>
</div>

<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">
        <div class="navbar-header"> <a href="javascript:void(0);" class="h-bars"></a> <a class="navbar-brand" href="index.html">Gafista</a></div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="zmdi zmdi-search"></i></a></li>
            
            
            <li><a href="sign-in.html" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            
        </ul>
    </div>
</nav>

<div class="menu-container">
    <div class="menu">
        <ul class="pullDown">
            <li><a href="index.html">Dashboard</a>
                
            </li>

            <li><a href="userprofile.html">My Profile</a>
                
            </li>
            <li><a href="javascript:void(0)">Wallet</a>
                <ul class="pullDown">                                   
                    <li><a href="uvwallet.php">View Wallet</a> </li>
                    <li><a href="atwallet.php">Fund Wallet</a> </li>
                    
                </ul>
            </li>
            <li><a href="javascript:void(0)">Ticket</a>
                <ul class="pullDown">
                    <li><a href="cuticket.html">Create Ticket</a> </li>
                    <li><a href="vuticket.html">View Ticket</a> </li>
                                    
                </ul>
            </li>
            <li><a href="verifypay.php">Verify Payments Made in Bank</a>

            <li><a href="javascript:void(0)">Property</a>
                <ul class="pullDown">
                    <li><a href="cuproperty.html">Create Property</a> </li>
                    <li><a href="vuproperty.html">View Property</a> </li>
                                    
                </ul>
            </li>
           
           
             
        </ul>
    </div>
</div>






<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                
                <h2 class="text-muted">Welcome to Gafista Application
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Gafista</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="body">
                        <!--modified to talk to Interswitch API -->
                        <?php 
	                        
	                        $_SESSION["txn_ref"] = "JB"  . intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) ); // random(ish) 7 digit int
	
                        ?>
                        <form action="interswitchxxx/confirm.php" method="POST">
                          <div class="form-group form-float">

                              <div class="form-line" hidden>
                                  <input type="text" id="id" class="form-control" name="cust_id" required>

                              </div>
                                <div class="form-line">
                                    <input type="text" id="email" class="form-control" name="useremail"  required disabled>
                                </div>
                                <div class="form-line">
                                    <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Payers Firstname" required>
                                    
                                </div>
                                <div class="form-line">
                                    <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Payers Lastname" required>
                                    
                                </div>
                                <div class="form-line">
                                    <input type="number" id="amount" class="form-control" name="amount" placeholder="Enter Amount" required>
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="checkbox" name="checkbox">
                                <label for="checkbox">I have entered all the details correctly</label>
                            </div>
                            <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--<script>

            function usersAmount(){
                return document.getElementById("amount").value;
            }
            var pay_amount = document.getElementById("amount").value;
            function usersEmail(){
                return document.getElementById("email").value;
            }
            var email = usersEmail();
            function userId(){
                return document.getElementById("id").value;
            }
            var user_id = userId();
            function userPhone(){
                return document.getElementById("phonenumber").value;
            }
            var user_phone = userPhone();

            function payWithPaystack(){
                var handler = PaystackPop.setup({
                    key: 'pk_test_b8483c3605f63e0e32a5c797e7e9092402f48412',
                    email: usersEmail(),
                    amount: usersAmount(),
                    ref: 'Gafista'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    metadata: {
                        custom_fields: [
                            {
                                display_name: "Mobile Number",
                                variable_name: "mobile_number",
                                value: user_phone
                            }
                        ]
                    },
                    callback: function(response){
                        window.location = "paystack/entry.php?amount="+usersAmount()+"&user_id="+userId();
                    },
                    onClose: function(){
                        alert('Payment Completed');
                    }
                });
                handler.openIframe();
            }
        </script>-->
    </div>
</section>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/countTo.bundle.js"></script>
<script src="assets/bundles/sparkline.bundle.js"></script>
<script src="assets/js/pages/widgets/infobox/infobox-1.js"></script>
<script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script> 
<script src="assets/js/pages/index2.js"></script>
<script>
    /*global $ */
    $(document).ready(function() {
        "use strict";
        $('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
        //Checks if li has sub (ul) and adds class for toggle icon - just an UI
      
        $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
      
        $(".menu > ul > li").hover(function(e) {
          if ($(window).width() > 943) {
            $(this).children("ul").stop(true, false).fadeToggle(150);
            e.preventDefault();
          }
        });
        //If width is more than 943px dropdowns are displayed on hover    
        $(".menu > ul > li").on('click',function() {
          if ($(window).width() <= 943) {
            $(this).children("ul").fadeToggle(150);
          }
        });
        //If width is less or equal to 943px dropdowns are displayed on click (thanks Aman Jain from stackoverflow)
      
        $(".h-bars").on('click',function(e) {
          $(".menu > ul").toggleClass('show-on-mobile');
          e.preventDefault();
        });
        //when clicked on mobile-menu, normal menu is shown as a list, classic rwd menu story (thanks mwl from stackoverflow)
      
      });
    </script>
<script src="paystack/inline.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a7201724b401e45400c8fb0/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html> 