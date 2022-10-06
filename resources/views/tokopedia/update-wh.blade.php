@extends('base/master')
@section('nav_active_deliv_tokped','active')

@push('ajaxheader')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endpush

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
        <br>
        <br>
        <div class="row">
            <!-- <div class="col-1"></div> -->
            <div class="col-9">
                
                <div class="card">
                    
                    
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="bx bx-info-circle" style="font-size:15px"></i> Update Price & Stock Warehouse</h4>
                        <hr>                                 
                        <br> 
                        <div align="center">           
                            <img src="{{ asset('assets/images/tokopedia-logo.gif')}}" width="250px">              
                            <p class="card-text">Proses ini akan mengupdate Harga dan Stok Warehouse di Tokopedia<br>berdasarkan data yang ada pada Sistem internal.</p>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="input-group col-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="option-offset" style="font-size: 11px;">Selesaikan Proses</span>
                                    </div>
                                    <input type="number" style="text-align: center;" class="form-control" name="offset" min="1" value="{{ $page }}" aria-describedby="option-offset" placeholder="Min 1" name="page" id="page">
                                </div>
                                <!-- <div class="col-3"> -->
                                    <button class="btn btn-success" id="submit">Submit</button> &nbsp;&nbsp;
                                    <!-- <button class="btn btn-light" id="reset" ><i class="bx bx-reset"></i> Reset</button> -->
                                <!-- </div> -->
                                
                            </div>
                        </div>

                         
                        <br>                                           
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="col-3">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="mb-0 font-size-15"><i class="bx bx-info-circle" style="font-size:15px"></i> Log</h4>
                    </div> -->
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="bx bx-info-circle" style="font-size:15px"></i> Log</h4>
                         <hr>
                        {{--<div class="row">
                            <div class="col-6">
                                <p style="color:green; font-weight: bold;">Berhasil :</p>
                                <b>Depok:</b> <strong style="color:green;" id="BD"></strong> <br>
                                <b>Bekasi:</b> <strong style="color:green;" id="BB"></strong> <br>
                                <b>Cililitan:</b> <strong style="color:green;" id="BC"></strong>                                
                            </div>
                            <div class="col-6">
                                <p style="color:red; font-weight: bold;">Gagal :</p>
                                <b>Depok:</b> <strong style="color:red;" id="GD"></strong> <br>
                                <b>Bekasi:</b> <strong style="color:red;" id="GB"></strong> <br>
                                <b>Cililitan:</b> <strong style="color:red;" id="GC"></strong> 
                            </div>
                        </div> --}}

                        {{-- <br>  --}}
                        {{-- <hr> --}}
                        <p style="color:red; font-weight: bold;">Produk Gagal Terupdate:</p>
                        <b>Depok :</b>
                        <ul id="depok">
                        </ul>

                        <b>Bekasi :</b>
                        <ul id="bekasi">
                        </ul> 
                          
                        <b>Cililitan :</b>
                        <ul id="cililitan">
                        </ul>    
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submit').click(function(e){
        
        e.preventDefault();
        var page = $('#page').val();
        

        if(page.length === 0){
                console.log('Pilih !');            
                Swal.fire({
                    title: "Oops...",
                    text: "Minimal Page Satu !",
                    type: "warning"
            })
        }else{
            Swal.fire({
                title: "Permintaan sedang diproses !",
                html: "Tunggu beberapa saat.",
                allowOutsideClick: false,
                onBeforeOpen: function() {
                    Swal.showLoading()
                }
            }),
            $.ajax({
                url:"{{ route('updateStockPrice')}}",
                type:"POST",
                data:{
                    page:page,
                },
                dataType: "json",
                
                success: function(results){
                    
                    if (results.success === true) {
                        console.log(results.page);
                        Swal.fire({  
                            type: "success",
                            title: "Berhasil !",  
                            html: results.message,                        
                            // html: "Permintaan berhasil diproses.",                        
                            showConfirmButton: false,
                            timer: 2000

                        }).then(function(t) {
                            t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                        }),
                        $("#bekasi").empty();                 
                        $("#cililitan").empty();                 
                        $("#depok").empty();                 
                        // $("#BD").empty();                 
                        // $("#BC").empty();                 
                        // $("#BB").empty();
                        // $("#GD").empty();                 
                        // $("#GC").empty();                 
                        // $("#GB").empty();
                        $('#page').val(results.page);
                        $("#bekasi").append(results.DataBKS);                 
                        $("#cililitan").append(results.DataCLT);                 
                        $("#depok").append(results.DataDPK);                 
                        // $("#BD").append(results.jumsuksesD);                 
                        // $("#BC").append(results.jumsuksesC);                 
                        // $("#BB").append(results.jumsuksesB);
                        // $("#GD").append(results.jumgagalD);                 
                        // $("#GC").append(results.jumgagalC);                 
                        // $("#GB").append(results.jumgagalB);                 
                    } else {
                        swal("Error!", results.message, "error");
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
                    })              
                }
            });
        }
    });
</script>
@endpush