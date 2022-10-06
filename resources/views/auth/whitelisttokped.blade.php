@extends('base/master')

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
    </ul>
</div>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                                

                <div class="card">                    
                    
                    <div class="card-body">
                        <h4 class="card-title mb-4"><i class="bx bx-info-circle" style="font-size:15px"></i> IP Whitelist Tokopedia</h4>
                        <hr>                                 
                        <br>           
                        <div class="row">
                            <div class="col-sm-6">
                              

                            </div>

                            <div class="col-3" align="right">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="myInput" autocomplete="off" placeholder="Search..." >
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                  </div>
                            </div>

                            <div class="col-3" align="right">
                                <div class="button-items">
                                    <button type="button" class="btn btn-success waves-effect btn-label waves-light" name="BtnPrice" id="BtnPrice">
                                        <i class="mdi mdi-ip-network label-icon"></i> Add IP Whitelist
                                    </button>
                                </div>
                            </div>                            
                        </div>                      
                        <br>
                        <table id="datatable-buttons" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <thead>
                                <tr>
                                  <th width="50">No</th>
                                  <th>IP Whitelist </th>
                                  <!-- <th width="150" align="center"></th> -->
                                </tr>
                              </thead>
                              <tbody id="myTable">
                                @foreach($Data as $result)
                                <tr>
                                    <td>{{ $loop-> iteration}}</td>
                                    <td><strong>
                                        {{ $result }}</strong>
                                    </td>
                                    <!-- <td align="center">
                                        <a href="/ip/hapus/{{$result}}" type="button" class="btn btn-danger"  onclick="return hapus()">
                                            Hapus IP &nbsp;<i class="fa fa-trash"></i>
                                        </a>
                                    </td> -->
                                </tr>                                
                                @endforeach                               
                              </tbody>
                        </table>                       
                        <br>                                           
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <div class="col-2"></div>
            <div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"><i class="bx bx-info-circle" ></i> Add IP Whitelist</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            IP Address                                 
                            <input type="text" class="form-control" name="ip" required autocomplete="off">
                                                                 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light" id="submittambah">Tambah
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div> <!-- container-fluid -->
    </div>
</div>
@endsection


@push('scripts')
<script>
    function hapus() {
      if (confirm("Yakin menghapus IP Whitelist ?")) {
        return true;
      } else {
        return false;
      }
    }
</script>
<script type="text/javascript">
    $('#BtnPrice').click(function(){
        $("#addUser").modal();        
        $('#submittambah').click(function(){
            var ip = document.getElementsByName('ip')[0].value;

            let _token   = $('meta[name="csrf-token"]').attr('content');
            
            if(ip.length === 0){
                Swal.fire({
                    title: "Oops...",
                    text: "Data Tidak Boleh Kosong !",
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
                    url:"{{ route('tambahipW')}}",
                    type:"POST",
                    data:{
                        ip:ip,
                        _token: _token
                    },
                    dataType: "json",
                    
                    success: function(results){                  

                        if (results.success === true) {
                            Swal.fire({  
                                type: "success",
                                title: "Berhasil !",                         
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function(t) {
                                t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                            })
                            $('#nama').val('');
                            $('#password').val('');
                            $('#mytable').empty();
                            location.reload();
                                        
                        } else {
                            swal("Error!", results.message, "error"); 
                            $('#addUser').modal('hide'); 
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
                        $('#addUser').modal('hide');                 
                    }
                });
            }
        });
    });
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