@extends('base/master')
@section('nav_active_deliv_report','active')

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
                        <h6 class="card-title"><i class="bx bx-info-circle" style="font-size:15px"></i>Report</h6>
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
                                        <form action="/export" method="post">
                                        @csrf
                                        <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-date-autoclose="true" data-provide="datepicker">
                                            <input type="text" class="form-control" placeholder="From" name="from_date" id="from_date" autocomplete="off" readonly>
                                            <input type="text" class="form-control" placeholder="To" name="to_date" id="to_date" autocomplete="off" readonly>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-success" name="BtnExport" id="BtnExport" type="submit"><i class="far fa-file-excel"></i> Export to Excel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-4" align="right">
                                    
                                    <!-- <button class="btn btn-success" name="BtnExport" id="BtnExport" type="submit"><i class="far fa-file-excel"></i> Export to Excel</button> -->
                                </div>
                            </div>                                            
                                                 
                            <br>
                        <table id="datatable-buttons" onkeyup="myFunction()" class="table table-striped table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size: 12px;">
                            <tr>
                                <th>id</th>
                                <th>item_id</th>
                                <th>branch_id</th>
                                <th>price</th>
                                <th>qty</th>
                                <th>user_id</th>
                                <th>create_date</th>
                                <th>status</th>
                            </tr>
                            @foreach($data as $new)
                            <tr>
                                <td>{{$new['id']}}</td>
                                <td>{{$new['item_id']}}</td>
                                <td>{{$new['branch_id']}}</td>
                                <td>{{$new['price']}}</td>
                                <td>{{$new['qty']}}</td>
                                <td>{{$new['user_id']}}</td>
                                <td>{{$new['create_date']}}</td>
                                <td>{{$new['status']}}</td>
                            </tr>
                            @endforeach
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
                url:'{{ route("deliv-report") }}',
                data:{from_date:from_date, to_date:to_date}
            },
            columns: [
                {$id, name: 'id'},
                {$item_id, name: 'item'},
                {$branch_id, name: 'branch'},
                {$price, name: 'price'},
                {$qty, name: 'qty'},
                {$user_id, name :'user_id'},
                {$create_date, name : 'create_date'},
                {$status, name:'status'},
            ]
        });
    }
    

    $('#filter').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        console.log(to_date);
        if(from_date != '' &&  to_date != ''){
            console.log('Filter date range');
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