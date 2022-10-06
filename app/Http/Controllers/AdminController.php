<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Auth;
use Hash;
use DataTables;
use App\Admin;
use DB;
use App\report;
use App\Exports\SendWaExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function export(Request $request) 
    {   
        $cabang = Auth::user()->cabang;
        $schema = Auth::user()->schema;
        $combidate1 = substr($request->from_date, 3, 3).substr($request->from_date, 0, 3).substr($request->from_date, 6, 4);
        $combidate2 = substr($request->to_date, 3, 3).substr($request->to_date, 0, 3).substr($request->to_date, 6, 4);

        $from_date  = date('Y-m-d 00:00:01', strtotime($combidate1));
        $to_date    = date('Y-m-d 23:59:59', strtotime($combidate2));

        $cek = DB::connection('oracle')->select("SELECT * FROM log_update_mp WHERE create_date >= '$from_date' AND create_date <= '$to_date'");
        
        if (count($cek) == 0) {
            return redirect('deliv-report')->with('datanull', 'Data Tidak Ditemukan');
        }else{
            return Excel::download( 'report send invoice from '.$from_date.' to '.$to_date.'.xlsx');
        }
    }

        public function delivreport(Request $request){
           $data = report::all();
            return view('admin.delivery-report', compact('data'));
         

        }
        

    public function masteruser(){
        $users = User::all()->sortByDesc('created_at');

        return view('auth.masteruser', compact('users'));
    }

    public function tambahuser(Request $request){

        User::create([
            'name'      => $request->nama,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'schema'    => 'null',
            'cabang'    => 'null',
            'role'    => 1
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data berhasil Diproses !'
        ]);
    }

    public function masteripW(){
        $BASIC = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
        $URL    = 'https://accounts.tokopedia.com/token';
        $response = Http::withHeaders([
            'Authorization' => $BASIC
        ])->post($URL.'?'.http_build_query([
                        'grant_type' => 'client_credentials',                  
                    ]))->json();
        $TOKEN = $response['access_token'];

        $BEARER = $TOKEN;
        $FS_ID  = '14130';
        $SHOP_ID= "8160708";

        $URL    = 'https://fs.tokopedia.net/v1/fs/14130/whitelist';
        $response = Http::withToken($BEARER)->get($URL)->json();
        $Data = $response['data']['ip_whitelisted'];
        // dd($Data);
        return view('auth.whitelisttokped', compact('Data'));
    }

    public function tambahipW(Request $request){
        // dd($request);
        $BASIC = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
        $URL    = 'https://accounts.tokopedia.com/token';
        $response = Http::withHeaders([
            'Authorization' => $BASIC
        ])->post($URL.'?'.http_build_query([
                        'grant_type' => 'client_credentials',                  
                    ]))->json();
        $TOKEN = $response['access_token'];

        $BEARER = $TOKEN;
        $FS_ID  = '14130';
        $SHOP_ID= "8160708";

        $URL    = 'https://fs.tokopedia.net/v1/fs/14130/whitelist';
        $body = array(
                        'insert' => [$request->ip ]
                    );
        $status = Http::withToken($BEARER)->withBody(json_encode($body), 'application/json')
                ->post($URL)->status();

        $pesanBerhasil = null;
        $pesanGagal = null;

        if ($status == 200) {
            return response()->json([
                'success'   => true,
                'message'   => 'Data berhasil Diproses !'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'message'   => 'Data gagal Diproses !'
            ]);
        }
        

    }
}
