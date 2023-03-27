<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use Carbon\Carbon;
use App\Vstock;
use App\LogUpdate;

class ProductTokpedController extends Controller
{
    public function index(Request $request)
    {
        // GET BASIC TOKEN
        $BASIC = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
        $URL    = 'https://accounts.tokopedia.com/token';
        $response = Http::withHeaders([
            'Authorization' => $BASIC
        ])->post($URL.'?'.http_build_query([
                'grant_type' => 'client_credentials',                  
            ]))->json();
        $TOKEN = $response['access_token'];
        
        // dd($TOKEN);

        $FS_ID  = '14130';
        $SHOP_ID= "8160708";

        

        if ($request->ajax()) {
            // Show data where shop id--------------------------------------------------------
            $URL    = 'https://fs.tokopedia.net/inventory/v1/fs/14130/product/info';
            $PAGE   = $request->page;
            $PER_PAGE = '10';
            $response = Http::withToken($TOKEN)->get($URL,[
                    'shop_id'   => $SHOP_ID,
                    'page'      => $PAGE,
                    'per_page'  => $PER_PAGE
                ])->json();
            
            $ProductData = $response['data'];
            $data= '';

            function format_uang($angka){ 
                $hasil =  number_format($angka,0, ',' , '.'); 
                return $hasil; 
            }

            if($PAGE > 1){
                
                $no = ($PAGE - 1) * 10;
            }else{
                $no = 0;
            }

            foreach ($ProductData as $post) {
                $no = $no+1;
                if (isset($post['price']['value'])) {
                    $price = $post['price']['value'];
                }else{
                    $price = 0;
                }

                if(isset($post['stock']['value'])){
                    $stock = $post['stock']['value'];
                }else{
                    $stock = 0;
                }

                if($post["basic"]["status"] == 1 AND 2){
                    $status = 'checked';
                }else{
                    $status = '';                    
                }

                if(!empty($post['other']['sku'])){
                    $psku = $post['other']['sku'];
                }else{
                    $psku = '';
                }
                
                $data.='<tr>
                    <td>
                         <input type="checkbox" name="data" class="selectBox" value="'. $psku .'"/>
                    </td>
                    <td>'.$no.'
                    </td>
                    <td>
                        <img src="'.$post['pictures'][0]['ThumbnailURL'].'" width="50px">
                    </td>
                    <td><a href='.$post['other']['url'].' style="text-decoration:none; color: #051946; font-size: 12px" target="_blank"><b>'.$post['basic']['name'].'</b> <i class="mdi mdi-open-in-new"></i></a><br>SKU : '.$post['other']['sku'].'</td>
                    <td>Rp. '.format_uang($price).'</td>
                    <td align="center">'.$stock.' 
                        <p style="font-size:11px">di '.count($post['warehouses']).' lokasi.</p></td>
                    <td align="center">
                        <input type="checkbox" id="switch1" switch="none" '.$status.' disabled>
                        <label for="switch1" data-on-label="" data-off-label=""></label>
                    </td>
                    </tr>';
            }
            // dd($data);
            return $data;
        }

        
        return view('tokopedia.index');
    }

    public function VupdateWH()
    {   
        $page = 1;
        // $cek = DB::connection('oracle')->select("SELECT * FROM VI_STOCK_MPLC_KONSOL WHERE item_no = '772A0K0JA0BRW' AND id_wh='11890185'");

        // dd($cek);

        return view('tokopedia.update-wh', compact('page'));
    }

    public function _getToken(){
        $BASIC = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
        $URL1    = 'https://accounts.tokopedia.com/token';

        $response = Http::withHeaders([
                'Authorization' => $BASIC
            ])->post($URL1.'?'.http_build_query([
                'grant_type' => 'client_credentials',                  
            ]))->json();

        $TOKEN = $response['access_token'];

        return $TOKEN;
    }

    public function _getResponsePost($body, $endpoint, $params){
        $respon = Http::withToken($this->_getToken())
            ->withBody(json_encode($body), 'application/json')
            ->post($endpoint
                .http_build_query($params)  
            )->json();
            
        return $respon;
    }

    // request ajax
    public function updateStokWH(Request $request){
        
        $SHOP_ID= "8160708";
        // GET DATA from Tokped
        $URL    = 'https://fs.tokopedia.net/inventory/v1/fs/14130/product/info';
        $PAGE   = $request->page;
        $PER_PAGE = '10';
        $response = Http::withToken($this->_getToken())->get($URL,[
                'shop_id'   => $SHOP_ID,
                'page'      => $PAGE,
                'per_page'  => $PER_PAGE
            ])->json();

        $ProductData = $response['data'];
       
        if ($ProductData == null) {
        
            return response()->json([
                'success'   => true,
                'message'   => 'Data Selesai Diproses !',
                'page'      => 1,
            ]);

        }    
        
        
        $whCililitan = [];
        $whDepok     = [];
        $whBekasi    = [];

        foreach ($ProductData as  $result) {
            if(!empty($result['other']['sku'])){
                $stokWH=[];
                $whid = ['11890185', '8352920', '12135078'];
                foreach($whid as $wh){
                    $cek = Vstock::where('item_no', '=', $result['other']['sku'])
                                    ->where('id_wh', '=', $wh)
                                    ->first();
                    // dd($cek->sw_branch_id);
    
                    if($cek){
                        $stokWH[] = array(
                                'item_id'       => $cek->item_no,
                                'qty'           => (int)$cek->qty,
                                'branch_id'     => $cek->sw_branch_id,
                                'price'         => $cek->price,
                                'user_id'       => $cek->id_wh,
                                'create_date'   => date('Y-m-d H.i.s', strtotime(Carbon::now())),
                                'status'        => $cek->wh_status,
                            );
    
                        $body[] = array(
                            'sku'   => $cek->item_no,
                            'new_stock' => (int)$cek->qty
                        );
                            
                        // UPDATE STOCK TOKPED
                        $params = [
                                'shop_id' => $SHOP_ID,  
                                'warehouse_id' => $cek->id_wh,
                                'bypass_update_product_status' => 0             
                            ];
                        $responStk = $this-> _getResponsePost($body, 'https://fs.tokopedia.net/inventory/v1/fs/14130/stock/update?', $params);
                        // dd($responStk);
                            
                        // update status to active
                        if ($cek->qty > 0) {
                            $body = [ "product_id" => $responStk['data']['succeed_rows_data'][0]['productID'] ];
                            $params =['shop_id' => $SHOP_ID];
    
                            $responstts = $this-> _getResponsePost($body, 'https://fs.tokopedia.net/v1/products/fs/14130/active?', $params);
                        }
                        // end update status to active
                        
                        // dd($responStk);
                    }else{
                        if($wh == '11890185'){ //bekasi
                            $whCililitan[] = $result['other']['sku'];
                        }elseif($wh == '8352920'){
                            $whDepok[] = $result['other']['sku'];
                        }else{
                            $whBekasi[] = $result['other']['sku'];
                        }
                    }
                }
                LogUpdate::insert($stokWH);
                $dataB = '';
                $dataC = '';
                $dataD = '';
    
                foreach ($whBekasi as $key) {
                     $dataB.='<li>'.$key.'</li>';
                }
    
                foreach ($whDepok as $key2) {
                     $dataD.='<li>'.$key2.'</li>';
                }
    
                foreach ($whCililitan as $key3) {
                     $dataC.='<li>'.$key3.'</li>';
                }
            }
            
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Permintaan berhasil diproses !',

            'DataBKS'   => $dataB,
            'DataCLT'   => $dataD,
            'DataDPK'   => $dataC,
            
            'page'      => $request->page + 1,
        ]);

        
    }

    // public function updateStokWH(Request $request){
    //     // ini_set('max_execution_time', 300);
    //     $SHOP_ID= "8160708";
    //     // GET DATA from Tokped
    //     $PAGE   = $request->page;
        
    //     $PER_PAGE = '5';
    //     $response =  Http::withToken($this->_getToken())->get('https://fs.tokopedia.net/inventory/v1/fs/14130/product/info',[
    //                 'shop_id'   => $SHOP_ID,
    //                 'page'      => $PAGE,
    //                 'per_page'  => $PER_PAGE
    //             ])->json();
    //         dd($response);
        
    //     $ProductData = $response['data'];
    //     $whCililitan = [];
    //     $whDepok     = [];
    //     $whBekasi    = [];

    //     $dataB = '';
    //     $dataC = '';
    //     $dataD = '';

    //     if ($ProductData == null) {
    //         return redirect()->route('update-wh')
    //             ->with('message', 'Data Selesai Diproses !')
    //             ->with('page', $PAGE)
    //             ->with('DataBKS', $dataB)
    //             ->with('DataCLT', $dataC)
    //             ->with('DataDPK', $dataD); 
            

    //     } 

    //     foreach ($ProductData as  $result) {
    //         if(!empty($result['other']['sku'])){
    //             $stokWH=[];
    //             $whid = ['11890185', '8352920', '12135078'];
    //             foreach($whid as $wh){
    //                 $cek = Vstock::where('item_no', '=', $result['other']['sku'])
    //                                 ->where('id_wh', '=', $wh)
    //                                 ->first();
    //                 // dd($cek->sw_branch_id);
    
    //                 if($cek){
    //                     $stokWH[] = array(
    //                             'item_id'       => $cek->item_no,
    //                             'qty'           => (int)$cek->qty,
    //                             'branch_id'     => $cek->sw_branch_id,
    //                             'price'         => $cek->price,
    //                             'user_id'       => $cek->id_wh,
    //                             'create_date'   => date('Y-m-d H.i.s', strtotime(Carbon::now())),
    //                             'status'        => $cek->wh_status,
    //                         );
    
    //                     $body[] = array(
    //                         'sku'   => $cek->item_no,
    //                         'new_stock' => (int)$cek->qty
    //                     );
                            
    //                     // UPDATE STOCK TOKPED
    //                     $params = [
    //                             'shop_id' => $SHOP_ID,  
    //                             'warehouse_id' => $cek->id_wh,
    //                             'bypass_update_product_status' => 0             
    //                         ];
    //                     $responStk = $this-> _getResponsePost($body, 'https://fs.tokopedia.net/inventory/v1/fs/14130/stock/update?', $params);
    //                     // dd($responStk);
                            
    //                     // update status to active
    //                     if ($cek->qty > 0) {
    //                         $body = [ "product_id" => $responStk['data']['succeed_rows_data'][0]['productID'] ];
    //                         $params =['shop_id' => $SHOP_ID];
    
    //                         $responstts = $this-> _getResponsePost($body, 'https://fs.tokopedia.net/v1/products/fs/14130/active?', $params);
    //                     }
    //                     // end update status to active
                        
    //                     // dd($responStk);
    //                 }else{
    //                     if($wh == '11890185'){ //bekasi
    //                         $whCililitan[] = $result['other']['sku'];
    //                     }elseif($wh == '8352920'){
    //                         $whDepok[] = $result['other']['sku'];
    //                     }else{
    //                         $whBekasi[] = $result['other']['sku'];
    //                     }
    //                 }
    //             }
    //             LogUpdate::insert($stokWH);
    //             $dataB = '';
    //             $dataC = '';
    //             $dataD = '';
    
    //             foreach ($whBekasi as $key) {
    //                  $dataB.='<li>'.$key.'</li>';
    //             }
    
    //             foreach ($whDepok as $key2) {
    //                  $dataD.='<li>'.$key2.'</li>';
    //             }
    
    //             foreach ($whCililitan as $key3) {
    //                  $dataC.='<li>'.$key3.'</li>';
    //             }
    //         }
            
    //     }
        
    //     return redirect()->route('update-wh')
    //         ->with('message','Permintaan berhasil diproses !')
    //         ->with('page', $PAGE + 1)
    //         ->with('DataBKS', $dataB)
    //         ->with('DataCLT', $dataC)
    //         ->with('DataDPK', $dataD);       
    // }

    public function productSelectedUpdate(Request $request){
        // GET BASIC TOKEN
        $BASIC  = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
        $URL    = 'https://accounts.tokopedia.com/token';

        $response = Http::withHeaders([
            'Authorization' => $BASIC
        ])->post($URL.'?'.http_build_query([
                        'grant_type' => 'client_credentials',                  
                    ]))->json();
        $TOKEN = $response['access_token'];
        
        $ALL = $request->data;
        $SHOP_ID    = "8160708";
        
        $persenharga = $request->persenharga;
        $Dikali = floatval(str_replace(',', '.', $persenharga)); //convert to float

        $URL    = 'https://fs.tokopedia.net/inventory/v1/fs/14130/product/info';
        $a=0;
        $hasil = [];       
        foreach ($ALL as $sku) {
            // endp get info product
            $response = Http::withToken($TOKEN)->get($URL,[
                'sku'       => $sku
            ]);

            $harga      = $response['data'][0]['price']['value'];

            // perhitungan
            $HASILPERSEN= $harga * $Dikali / 100;
            
            if($request->aksiharga == 'naik'){
                $HARGAFIX   = $harga + $HASILPERSEN;                
            }else{
                $HARGAFIX   = $harga - $HASILPERSEN;
            }

            $HARGAFIX   = (int)$HARGAFIX;
            $hasil[$a] = array('sku' => $sku, 'new_price' => $HARGAFIX);
            
            $a++;
        }               
        
        $res = Http::withToken($TOKEN)
            ->withBody(json_encode($hasil), 'application/json')
            ->post('https://fs.tokopedia.net/inventory/v1/fs/14130/price/update?'.http_build_query([
                        'shop_id' => $SHOP_ID,                  
                    ])
            );              
        dd($res->json());
        return response()->json([
            'success'   => true,
            'message'   => 'Data Selesai Diproses !'
        ]);
        
    }
}
