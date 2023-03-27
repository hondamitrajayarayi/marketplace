<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <title>Marketplace APP | MitraJaya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="© 2021 IT Development - Marketplace APP | MitraJaya" name="description">
        <meta content="IT MitraJaya" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets\images\favicon.ico')}}">

        <!-- DataTables -->
        <link href="{{ asset('assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Responsive Table css -->
        <link href="{{ asset('assets\libs\admin-resources\rwd-table\rwd-table.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">   

        <link href="{{ asset('assets\libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"> 
        <link rel="stylesheet" href="{{ asset('assets\libs\@chenfengyuan\datepicker\datepicker.min.css')}}">
        <!-- Sweet Alert-->
        <link href="{{ asset('assets\libs\sweetalert2\sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets\css\bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('assets\css\icons.min.css')}}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('assets\css\app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"> 
        <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />    
        @stack('ajaxheader')
        
         <style type="text/css">
             
           
            .loader-wrapper {
              width: 100%;
              height: 100%;
              position: absolute;
              top: 0;
              left: 0;
              background-color: #242f3f;
              display:flex;
              justify-content: center;
              align-items: center;
            }
            .loader {
              display: inline-block;
              width: 30px;
              height: 30px;
              position: relative;
              border: 4px solid #Fff;
              animation: loader 2s infinite ease;
            }
            .loader-inner {
              vertical-align: top;
              display: inline-block;
              width: 100%;
              background-color: #fff;
              animation: loader-inner 2s infinite ease-in;
            }
            @keyframes loader {
              0% { transform: rotate(0deg);}
              25% { transform: rotate(180deg);}
              50% { transform: rotate(180deg);}
              75% { transform: rotate(360deg);}
              100% { transform: rotate(360deg);}
            }
            @keyframes loader-inner {
              0% { height: 0%;}
              25% { height: 0%;}
              50% { height: 100%;}
              75% { height: 100%;}
              100% { height: 0%;}
            }
         </style>     
    </head>

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets\images\logo.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets\images\logo-dark.png')}}" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets\images\logo-light.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets\images\logo-ligh.png')}}" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>


                    <div class="d-flex">
                        

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <!-- <a href="/create-ticket" type="button" class="btn btn-outline-info">
                                <i class="bx bx-plus-medical"></i>&nbsp;&nbsp;CREATE NEW TICKET
                            </a> -->

                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>  
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets\images\users\avatar-1.jpg')}}" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="/masteruser"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Master User</a> 
                                <a class="dropdown-item" href="/masteripW"><i class="mdi mdi-ip-network font-size-16 align-middle mr-1"></i> IP Whitelist Tokopedia</a> 
                                <!-- Premium Member <i class="fa fa-check-circle" style="color:green"></i> -->
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-alt font-size-16 align-middle mr-1"></i> Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                                    Logout
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>                                

                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
    
                <div class="topnav">
                    <div class="container-fluid">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                            @yield('menunav')                          

                        </nav>
                    </div>
                </div>           

        </div>
        <!-- END layout-wrapper -->
        
        <div class="main-content">
            
            @yield('content')
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                           © <script>document.write(new Date().getFullYear())</script> IT Development - Marketplace APP | MitraJaya
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                <!-- Help Desk System | Mitra Jaya -->
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Right bar overlay-->
        <!-- <div class="rightbar-overlay"></div> -->

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets\libs\jquery\jquery.min.js')}}"></script>
        <script src="{{ asset('assets\libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets\libs\metismenu\metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets\libs\simplebar\simplebar.min.js')}}"></script>
        <script src="{{ asset('assets\libs\node-waves\waves.min.js')}}"></script>


        <!-- apexcharts -->
        <script src="{{ asset('assets\libs\apexcharts\apexcharts.min.js')}}"></script>

        <script src="{{ asset('assets\js\pages\dashboard.init.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('assets\libs\datatables.net\js\jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>

        <!-- Responsive Table js -->
        <script src="{{ asset('assets\libs\admin-resources\rwd-table\rwd-table.min.js')}}"></script>

        <script src="{{ asset('assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets\libs\jszip\jszip.min.js')}}"></script>
        <script src="{{ asset('assets\libs\pdfmake\build\pdfmake.min.js')}}"></script>
        <script src="{{ asset('assets\libs\pdfmake\build\vfs_fonts.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
        <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.colVis.min.js')}}"></script>
        <!-- Datatable init js -->
        <!-- <script src="{{ asset('assets\js\pages\datatables.init.js')}}"></script>   -->

        <script src="{{ asset('assets\libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('assets\libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js')}}"></script>
        <!-- bs custom file input plugin -->
        <script src="{{ asset('assets\libs\bs-custom-file-input\bs-custom-file-input.min.js')}}"></script>
        <script src="{{ asset('assets\js\pages\form-element.init.js')}}"></script>
        <!-- form advanced init -->
        <script src="{{ asset('assets\js\pages\form-advanced.init.js')}}"></script>
        <!-- Init js -->
        <script src="{{ asset('assets\js\pages\table-responsive.init.js')}}"></script>  
        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets\libs\sweetalert2\sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js-->
        <script src="{{ asset('assets\js\pages\sweet-alerts.init.js')}}"></script>

        <script src="{{ asset('assets\js\app.js')}}"></script>

        

        @stack('scripts')
        

    </body>
</html>
