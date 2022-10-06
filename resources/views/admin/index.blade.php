@extends('base/master')
@section('nav_active_dashboard','active')

@section('menunav')  
<div class="collapse navbar-collapse" id="topnav-menu-content">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_dashboard')" href="/admin" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-dashboard mr-1"></i>Dashboards
            </a>                                       
        </li>

 
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-store-alt mr-1"></i>Marketplace <div class="arrow-down"></div>
            </a>
            <div class="dropdown-menu" aria-labelledby="topnav-pages">
                <a href="/productTokped" class="dropdown-item @yield('nav_active_deliv_tokped')">Tokopedia</a>
                <a href="/productBlibli" class="dropdown-item @yield('nav_active_deliv_blibli')">Blibli</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_deliv_report')" href="#" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-shopping-bag-alt mr-1"></i>Order
            </a>                                       
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_bc')" href="#" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="dripicons-broadcast mr-1"></i> Campaign
            </a>                                       
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_deliv_report')" href="#" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-chat mr-1"></i>Interaction
            </a>                                       
        </li>
        <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle @yield('nav_active_deliv_report')" href="/deliv-report" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-file mr-1"></i>Delivery Report
            </a>                                       
        </li>
    </ul>
</div>
@endsection

@section('content')  
 <div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Hi, Welcome Back !</h5>
                                    <p>Dashboard</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('assets\images\profile-img.png')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="{{ asset('assets\images\users\avatar-1.jpg')}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="pt-4">

                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="font-size-15"><i class="bx bx-user"></i>&nbsp;&nbsp;
                                             admin<i class="mdi mdi-circle text-success" style="font-size: 10px"></i>
                                            </h5>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                      
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    
                    <div class="col-md-4">
                        
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Empty No.</p>
                                        <h4 class="mb-0">0</h4>
                                    </div>

                                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-close-circle-outline font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- end row -->
                <!-- <div class="row">
                    <div class="col-md-7">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">chart</p>
                                        <div align="center">                                            
                                            <img src="{{ asset('assets\images\tes-qr.png')}}" width="193px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Konektivitas</p>
                                                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
