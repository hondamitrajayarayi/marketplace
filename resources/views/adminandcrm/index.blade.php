@extends('base/master')
@section('nav_active_dashboard','active')

@section('menunav')  
<div class="collapse navbar-collapse" id="topnav-menu-content">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_dashboard')" href="/dashboard" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-dashboard mr-1"></i>Dashboards
            </a>                                       
        </li>

       <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_send_inv')" href="/list-invoice-su" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-send mr-1"></i>Send Invoice
            </a>                                       
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_bc')" href="/bc-su" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="dripicons-broadcast mr-1"></i> Broadcast
            </a>                                       
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-file mr-1"></i>Delivery Report <div class="arrow-down"></div>
            </a>
            <div class="dropdown-menu" aria-labelledby="topnav-pages">
                <a href="/deliv-report-su" class="dropdown-item @yield('nav_active_deliv_report')">Send Invoice</a>
                <a href="#" class="dropdown-item">Broadcast</a>
            </div>
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
                                             {{ Auth::user()->name }} <i class="mdi mdi-circle text-success" style="font-size: 10px"></i>
                                            </h5>
                                            <p class="text-muted"><i class="bx bx-buildings"></i>&nbsp;&nbsp;&nbsp;
                                              {{ Auth::user()->cabang }}
                                            </p>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
