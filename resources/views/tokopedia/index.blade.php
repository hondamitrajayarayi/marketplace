@extends('base/master')
@section('nav_active_deliv_tokped','active')

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
            <div class="col-12">
                
                <div class="card">
                    
                    <div class="card-body">

                        <h5 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Product Tokopedia </h5>
                        <br>
                           

                            <div class="row">
                                <div class="col-sm-3">
                                  <div class="input-group">
                                    <input type="text" class="form-control" id="myInput" autocomplete="off" placeholder="Search..." >
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                  </div>

                                </div>

                                <div class="col-2" align="right">
                                    
                                </div>

                                <div class="col-7" align="right">
                                    <div class="button-items">
                                    <button type="button" class="btn btn-info waves-effect btn-label waves-light" name="BtnPrice" id="BtnPrice"><i class="bx bx-check-double label-icon"></i> Update Prices Selected</button>

                                    <a href="/productTokped/update-wh" class="btn btn-primary waves-effect btn-label waves-light" name="BtnSend" id="BtnSend" type="button"><i class="mdi mdi-update label-icon"></i> Update Price & Stock Warehouse</a>
                                    </div>
                                </div>
                            </div>                                            
                                                 
                            <br>
                        <table id="datatable-buttons" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input selectAll" id="selectAll" name="all" type="checkbox">
                                    </div>
                                </th>
                                <th>No</th>
                                <th colspan="2">Info Produk</th>
                                <th>Price</th>
                                <th align="center">Stock</th>
                                <th align="center">Aktif</th>
                            </tr>
                            </thead>
                            <tbody id="mytableload">
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-0">
                                        <div class="ph-item big p-0 mb-0 border-0" id="listloading">
                                            <div class="ph-col-12 p-1 mb-0">
                                                <div class="ph-row">
                                                    <div class="ph-col-12 big ph-border-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody id='mytable'>  
                                                                              
                            </tbody>
                            
                            <tfoot>
                                <th colspan="7">
                                    <div class="row mt-1 mb-1">
                                        <div class="col-9"> &nbsp;</div>
                                        <div class="input-group col-3" >
                                            <div class="input-group">
                                            <button class="btn btn-secondary" type="button" id="loadmoremin">Previous</button>
                                            &nbsp;&nbsp;<input type="text" min="1" class="form-control text-center" id="txtpage"> &nbsp;&nbsp;
                                            <button class="btn btn-secondary" type="button" id="loadmore">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- <button class="btn btn-light" id="loadmore">Previous</button></center>
                                    <input type="number" style="text-align: center;" class="form-control" name="offset" min="1" value="1" aria-describedby="option-offset" placeholder="Min 1" id="page">
                                
                                    <button class="btn btn-light" id="loadmore">Next</button></center> --}}
                                </th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div id="ModalHarga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel"><i class="bx bx-info-circle" ></i> Update Prices Selected</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-2"> 
                            <input type="hidden" id="Dataitem" name="Dataitem">
                        </div>
                        <div class="col-8">
                            <div class="input-group" >
                                <select name="aksiharga" id="formrow-inputState" class="form-control" >
                                    <option value="naik">Naikan Harga</option>
                                    <option value="turun">Turunkan Harga</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Contoh : 0.5" id="persenharga" name="persenharga" required autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success waves-effect waves-light" id="submitHarga">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- container-fluid -->
</div>
@endsection


@push('scripts')
<script>
    
    // var page = 1; //track user scroll as page number, right now page number is 1
    load_more( !$('#txtpage').val() ? 1 : $('#txtpage').val()); //initial content load
    if (!$('#txtpage').val()) {
        $('#txtpage').val(1)
    }
    var txtpage = document.getElementById("txtpage");
    txtpage.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            if ($('#txtpage').val() > 0) {
                $("#mytable").empty();
                load_more($('#txtpage').val());
            }else{
                alert('Min page 1 !');
            }  
        }
    });
    $('#loadmoremin').click(function(){
        var pg = parseInt($('#txtpage').val()) - 1;
        $("#mytable").empty();
        if (pg > 0) {
            $('#txtpage').val(pg);
            load_more(pg);
        }else{
            pg++;
            alert('Min page 1 !');
            load_more(1);
        }
        console.log(page);
    }); 
     
    $('#loadmore').click(function(){
        var pg = parseInt($('#txtpage').val()) + 1;
        $("#mytable").empty();
        console.log(pg);
        $('#txtpage').val(pg);
        // load_more(page);
        load_more(pg);
    });    

    function load_more(page){
        console.log(page);
        $('#mytableload').removeAttr('hidden');
        // 
        $.ajax({
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            beforeSend: function(){
                $('.ajax-loading').show();
            }
        }).done(function(data){
            if(data.length == 0){
                console.log(data);
                alert('Maksimum Data!')
                //notify user if nothing to load
                $('.ajax-loading').html("No more records!");
                return;
            }
            
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $('#mytableload').attr('hidden','hidden');
            $("#mytable").empty();
            $("#mytable").append(data); //append data into #results element          
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
              alert('all data is displayed ! ');
              load_more(1);
              $('#txtpage').val('1');
        });
    }

    $('#BtnPrice').click(function(){
        var data = [];
        $("#Dataitem").val('');
        $('.selectBox:checked').each(function(i){
              data[i] = $(this).val();
        });
        console.log(data); 
        
        if(data.length === 0){
            console.log('Pilih !');            
            Swal.fire({
                title: "Oops...",
                text: "Pilih minimal satu data !",
                type: "warning"
            });
            return false;
        }else{
            console.log(data);
            $("#ModalHarga").modal();
            $("#Dataitem").val(data);
        }
        
        
    });
    $('#submitHarga').click(function(){
        var data = $("#Dataitem").val();
        let _token   = $('meta[name="csrf-token"]').attr('content'); 
        console.log(data);
        var aksiharga = document.getElementsByName('aksiharga')[0].value;
        var persenharga = document.getElementsByName('persenharga')[0].value;
        // var page = 1;
        // console.log(aksiharga);
        Swal.fire({
            title: "Permintaan sedang diproses !",
            html: "Tunggu beberapa saat.",
            allowOutsideClick: false,
            onBeforeOpen: function() {
                Swal.showLoading()
            }
        }),
        $.ajax({
            url:"{{ route('productSelUpdate')}}",
            type:"POST",
            data:{
                data:data,
                aksiharga:aksiharga,
                persenharga:persenharga,
                _token: _token
            },
            dataType: "json",
            
            success: function(results){                  

                if (results.success === true) {
                    Swal.fire({  
                        type: "success",
                        title: "Berhasil !",  
                        html: "Harga Product terpilih berhasil diproses.",                        
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function(t) {
                        t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                    })
                    $('.selectBox').prop('checked', false);
                    $('.selectAll').prop('checked', false);
                    $('#ModalHarga').modal('hide');
                    $('#persenharga').val('');
                    $('#mytable').empty();
                    load_more($('#txtpage').val());                
                } else {
                    swal("Error!", results.message, "error");
                    $('.selectAll').prop('checked', false);
                    $('.selectBox').prop('checked', false); 
                    $('#ModalHarga').modal('hide'); 
                }             
            },
            error: function(results){
                Swal.fire({  
                    type: "warning",
                    title: "Request Time Out !", 
                    html: "Silahkan Proses Ulang",                         
                    showConfirmButton: false,
                    timer: 5000
                }).then(function(t) {
                    t.dismiss === Swal.DismissReason.timer && console.log("gagal !")
                }),
                $('.selectAll').prop('checked', false);
                $('.selectBox').prop('checked', false);
                $('#ModalHarga').modal('hide');                 
            }
        });
    });
</script>

<script type="text/javascript">
    $('.selectAll').click(function(){
          $('.selectBox').prop('checked', $(this).prop('checked'));
    })
    $('.selectBox').change(function(){
        var total = $('.selectBox').length;
        var number = $('.selectBox:checked').length;
       if (total == number){
         $('.selectAll').prop('checked', true);
       }else{
         $('.selectAll').prop('checked', false);
      }
    })
</script>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#mytable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endpush