@extends('base/master')
@section('nav_active_send_inv','active')

@section('menunav')
 
<div class="collapse navbar-collapse" id="topnav-menu-content">
    <ul class="navbar-nav">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_dashboard')" href="/admin" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bxs-dashboard mr-1"></i>Dashboards
            </a>                                       
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @yield('nav_active_send_inv')" href="/list-invoice" id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-send mr-1"></i>Send Invoice
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

                        <h5 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i> Select customer to send invoice </h5>
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

                                <div class="col-5">
                                    <div>
                                        <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-date-autoclose="true" data-provide="datepicker">
                                            <input type="text" class="form-control" placeholder="From" name="from_date" id="from_date" autocomplete="off" readonly>
                                            <input type="text" class="form-control" placeholder="To" name="to_date" id="to_date" autocomplete="off" readonly>
                                            &nbsp;&nbsp;
                                            <button class="btn btn-secondary" name="filter" id="filter"><i class="bx bx-filter-alt"></i> Filter</button> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4" align="right">
                                    <button class="btn btn-primary" name="BtnSend" id="BtnSend" type="button"><i class="bx bxs-send"></i> Send invoice to selected customer</button>
                                </div>
                            </div>                                            
                                                 
                            <br>
                        <table id="datatable-buttons" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input selectAll" name="all" type="checkbox">
                                    </div>
                                </th>
                                <th>No. Invoice</th>
                                <th>Invoice Document No.</th>
                                <th>Customer name</th>
                                <th>Phone</th>
                                <th>Company name</th>
                                <th>Invoice Date</th>
                            </tr>
                            </thead>

                            <tbody id='mytable'>                                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <!-- </form> -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection

@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    load_data();
    function load_data(from_date = '', to_date = '') {
        
        $('#datatable-buttons').DataTable({
            "bSearch": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": true,
            "bAutoWidth": false,
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("list-invoice") }}',
                data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                {data: 'check', name: 'invoice_id', orderable: false, searchable: false},
                {data: 'invoice_id', name: 'invoice_id'},
                {data: 'invoice_doc_no', name: 'invoice_doc_no'},
                {data: 'invoice_customer_name', name: 'invoice_customer_name'},
                {data: 'phone', name: 'phone'},
                {data: 'comp_name', name: 'comp_name'},
                {data: 'invoice_date', name: 'invoice_date'},
            ]
        });
    }
    

    $('#filter').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' &&  to_date != ''){
            // $('#datatable-buttons').DataTable().destroy();
            $('#datatable-buttons').dataTable({
                     "bDestroy": true   
            });
            $('#datatable-buttons').dataTable().fnDestroy();

            $('#mytable').empty();
            load_data(from_date, to_date);
        }else{
            console.log('Pilih tanggal !');            
            Swal.fire({
                title: "Oops...",
                text: "Rentang tanggal tidak boleh kosong",
                type: "error"
            })
        }
    });


!function(t) { 
        t("#BtnSend").on("click", function() {
            var t;
            var invoice_id = [];
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            $(':checkbox:checked').each(function(i){
              invoice_id[i] = $(this).val();
            });
            let _token   = $('meta[name="csrf-token"]').attr('content'); 
            if(invoice_id.length === 0){
                console.log('Pilih !');            
                Swal.fire({
                    title: "Oops...",
                    text: "Pilih minimal satu data !",
                    type: "warning"
                })
            }else if(invoice_id.length > 5){
                console.log('Maksimal 5 !');            
                Swal.fire({
                    title: "Oops...",
                    text: "Pilih Maksimal 5 Data !",
                    type: "info"
                }),
                $('.selectAll').prop('checked', false);
                $('.selectBox').prop('checked', false); 
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
                url:"{{ route('send-invoice')}}",
                type:"POST",
                data:{
                    invoice_id:invoice_id,
                    _token: _token
                },
                dataType: "json",
                
                success: function(results){
                    

                    if (results.success === true) {
                        Swal.fire({  
                            type: "success",
                            title: "Berhasil !",  
                            html: "Permintaan sudah masuk antrian.",                        
                            showConfirmButton: false,
                            timer: 3000
                        }).then(function(t) {
                            t.dismiss === Swal.DismissReason.timer && console.log("Sukses !")
                        }),
                        $('#datatable-buttons').dataTable().fnDestroy();
                        $('#mytable').empty();
                        load_data(from_date, to_date);
                        console.log('Reload data');
                        $('.selectBox').prop('checked', false);                 
                    } else {
                        swal("Error!", results.message, "error");
                        $('#datatable-buttons').dataTable().fnDestroy();
                        $('#mytable').empty();
                        load_data(from_date, to_date);
                        $('.selectBox').prop('checked', false);  
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
                    $('#datatable-buttons').dataTable().fnDestroy();
                    $('#mytable').empty();
                    load_data(from_date, to_date);
                    $('.selectAll').prop('checked', false);
                    $('.selectBox').prop('checked', false);                 
                }
            });
                
            }
        }),
    t.SweetAlert = new e,
    t.SweetAlert.Constructor = e
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.SweetAlert.init()
}();
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
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
@endpush