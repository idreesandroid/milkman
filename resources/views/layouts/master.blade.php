<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="CRMS - Bootstrap Admin Template">
      <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
      <meta name="author" content="Dreamguys - Bootstrap Admin Template">
      <meta name="robots" content="noindex, nofollow">
      <title>Milk Man App</title>
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
      <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
      <!--font style-->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
      <!-- Lineawesome CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
      <!-- Chart CSS -->
      <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
      <!-- Theme CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/theme-settings.css')}}">
      <!-- Main CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/custom_style.css')}}">
      <!-- jQuery -->
      <script src="{{asset('assets/js/jquery-3.5.0.min.js')}}"></script>
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
      

      
      <script>
         function printDiv(div_id) 
         {
         
           var divToPrint=document.getElementById(div_id);
         
           var newWin=window.open('','Print-Window');
         
           newWin.document.open();
         
           newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
         
           newWin.document.close();
         
           setTimeout(function(){newWin.close();},10);
         
         }
      </script>
   </head>
   <body id="skin-color" class="skin-color inter">
      <!-- Main Wrapper -->
      <div class="main-wrapper">
      <!-- Header -->
      <div class="header" id="heading">
         <!-- Logo -->
         <div class="header-left">
            <a href="/" class="logo">
            <img src="{{asset('assets/img/logo.png')}}"  alt="Logo" class="sidebar-logo">
            <img src="{{asset('assets/img/s-logo.png')}}"  alt="Logo" class="mini-sidebar-logo">
            </a>
         </div>
         <!-- /Logo -->
         <a id="toggle_btn" href="javascript:void(0);">
         <span class="bar-icon">
         <span></span>
         <span></span>
         <span></span>
         </span>
         </a>
         <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
         <!-- Header Menu -->
         <ul class="nav user-menu">
            <!-- Notifications -->
            <li class="nav-item dropdown">
               <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
               <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
               </a>
               <div class="dropdown-menu notifications">
                  <div class="topnav-dropdown-header">
                     <span class="notification-title">Notifications</span>
                     <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                  </div>
                  <div class="noti-content">
                     <ul class="notification-list">
                        <li class="notification-message">
                           <a href="#">
                              <div class="media">
                                 <span class="avatar">
                                 <img alt="" src="{{asset('assets/img/profiles/avatar-02.jpg')}}">
                                 </span>
                                 <div class="media-body">
                                    <p class="noti-details">
                                       <span class="noti-title">John Doe</span>
                                       added new task 
                                       <span class="noti-title">Patient appointment booking</span>
                                    </p>
                                    <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                 </div>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="topnav-dropdown-footer">
                     <a href="#">View all Notifications</a>
                  </div>
               </div>
            </li>
            <!-- /Notifications -->    
            <li class="nav-item dropdown has-arrow main-drop">
               <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
               <span>{{ session()->get('user_name') }}</span>
               </a>
               <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">My Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
                  @if(session()->get('user_name') !="" )
                  <a class="dropdown-item" href="/logout">Logout</a>  
                  @endif 
               </div>
            </li>
         </ul>
         <!-- /Header Menu -->
      </div>
      <!-- /Header -->
      <!-- Sidebar -->
      <div class="sidebar" id="sidebar">
         <div class="sidebar-inner slimscroll">
            <form action="search.html" class="mobile-view">
               <input class="form-control" type="text" placeholder="Search here">
               <button class="btn" type="button"><i class="fa fa-search"></i></button>
            </form>
            <div id="sidebar-menu" class="sidebar-menu">
               <ul>
                  <li class="nav-item nav-profile">
                     <a href="#" class="nav-link">
                        <div class="nav-profile-text d-flex flex-column">
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                     </a>
                  </li>
                  @include('admin_nav');
               </ul>
            </div>
         </div>
      </div>
      <!-- /Sidebar -->
      <!-- Page Wrapper -->
      <div class="page-wrapper">
      <div class="content container-fluid">
        
         <!-- page content -->
         @yield('content')
         <!-- page content -->
      </div>
      <!-- /Main Wrapper -->
      <!-- Bootstrap Core JS -->
      <script src="{{asset('assets/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <!-- Slimscroll JS -->
      <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
      <!-- Chart JS -->
      <!--<script src="{{asset('assets/js/morris.js')}}"></script>
         <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
          <script src="{{asset('assets/js/chart.js')}}"></script> -->
      <!-- <script src="{{asset('assets/js/linebar.min.js')}}"></script>
         <script src="{{asset('assets/js/piechart.js')}}"></script> -->
      <!-- <script src="{{asset('assets/js/apex.min.js')}}"></script> -->
      <!-- theme JS -->
      <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>  
      <script async defer
         src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places,drawing&key=AIzaSyA4d_ChkEg7E_k9rU7zPt09FVPGKpL1aAE&v=3&callback=initAutocomplete"      
         ></script>
      <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places,drawing&key=AIzaSyA4d_ChkEg7E_k9rU7zPt09FVPGKpL1aAE&v=3&callback=initializeMap"></script> -->
      <!-- <script
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4d_ChkEg7E_k9rU7zPt09FVPGKpL1aAE&callback=initAutocomplete&libraries=places&v=weekly"
         defer
         ></script> -->
      <script src="{{asset('assets/js/theme-settings.js')}}"></script>
      <!-- Custom JS -->
      <script src="{{asset('assets/js/app.js')}}"></script>
      <!-- <script src="{{asset('assets/js/jquery.js')}}"></script> -->
      <script src="{{asset('assets/js/inputmask.js')}}"></script>
      <!---------ajax---------------->
  
  
   </body>
</html>

