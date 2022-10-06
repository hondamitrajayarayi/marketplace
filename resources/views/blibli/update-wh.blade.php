@extends('base/master')
@section('nav_active_deliv_blibli','active')

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
                        <h4 class="card-title mb-4"><i class="bx bx-info-circle" style="font-size:15px"></i> Update Price & Stock </h4>
                        <hr>                                 
                        <br> 
                        <div align="center"> 
                            <img src="{{ asset('assets/images/icon_blibli.png')}}" width="30px">  
                            &nbsp;&nbsp; <i class='fas fa-sync fa-spin' style="font-size: 18px"></i> &nbsp;&nbsp;   
                            <img src="{{ asset('assets/images/icon_tokped.png')}}" width="45px">          
                            <br>          
                            <br>          
                            <p class="card-text">Proses ini akan mengupdate Harga dan Stok di Blibli berdasarkan<br> sinkronisasi data dengan Tokopedia.</p>
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
                        <p style="color:green; font-weight: bold;">Berhasil : </p>
                        <ul id="databerhasil">
                        </ul>
                        <br> 
                        <hr>
                        <p style="color:red; font-weight: bold;">Gagal Terupdate:</p>
                        
                        <ul id="datagagal">
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
    $('#submit').click(function(){
        var page = $('#page').val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        console.log(page);

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
                url:"{{ route('updateStockPriceBlibli')}}",
                type:"POST",
                data:{
                    page:page,
                    _token: _token
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
                        $("#jumsukses").empty();            
                        $("#datagagal").empty();            
                        $("#databerhasil").empty();            
                        $('#page').val(results.page);                 
                        $("#jumsukses").append(results.jumsukses);            
                        $("#datagagal").append(results.datagagal);                
                        $("#databerhasil").append(results.databerhasil);                
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