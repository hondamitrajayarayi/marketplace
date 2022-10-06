<?php

namespace App\Exports;

use DB;
use Auth;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SendWaExport implements FromView{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $from_date, string $to_date){
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View{   
     
        $data = DB::connection('oracle')->table('log_update_mp')->get();
    
    
        if ($data == []) {
            // return false;
            return response()->json([
                'success' => false,
                'message' => 'Query Salah',
            ]);
        }else{
            return view('report.report', [
                'data' => $data
            ]);        
        }
    } 
}
