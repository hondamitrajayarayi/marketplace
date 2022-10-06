<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Report;
use PDF;
use Auth;


use DataTables;
class ReportController extends Controller
{
    public function delivreport(Request $request){
      ini_set('max_execution_time', 300);
      $data=DB::connection('oracle')->table('log_update_mp');
      return $data;

    }
    public function export(Request $request) 
    {   
        $cabang = Auth::user()->cabang;
        $schema = Auth::user()->schema;
        $combidate1 = substr($request->from_date, 3, 3).substr($request->from_date, 0, 3).substr($request->from_date, 6, 4);
        $combidate2 = substr($request->to_date, 3, 3).substr($request->to_date, 0, 3).substr($request->to_date, 6, 4);

        $from_date  = date('Y-m-d 00:00:01', strtotime($combidate1));
        $to_date    = date('Y-m-d 23:59:59', strtotime($combidate2));

        $data =DB::connection('oracle')->table('log_update_mp');
        
       {
            return Excel::download(new ReportExport($from_date, $to_date), 'report send invoice from '.$from_date.' to '.$to_date.'.xlsx');
        }

    }
  }



