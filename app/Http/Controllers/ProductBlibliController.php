<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class ProductBlibliController extends Controller
{
    public function index(Request $request){
       
        $ENDP = 'https://api.blibli.com/v2/proxy/mta/api/businesspartner/v2/product/getProductList';
        $body = array(
                        'size'          => 5, //max 100
                        'page'          => $request->page,
                    );
        
        $response = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
            ->withBody(json_encode($body), 'application/json')
            ->withHeaders([
                'Api-Seller-Key' => 'BEB7A4CFEECA91E38948327F38ECF6B110768F664E49AE734957E4554E3828E7',
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ])->post($ENDP.'?'.http_build_query([
                                'requestId' => 'eb20408b-dd59-4cbc-9979-ff50ab54d98b',
                                'businessPartnerCode' => 'HOM-60047',
                                'username'  => 'h.mitrajaya@gmail.com',
                                'channelId' => 'Honda Mitra Jaya Group'             
                            ]))->json();
        // dd($response['content']);
        $ProductData = $response['content'];
   
        if ($request->ajax()) {
           
            $data= '';

            function format_uang($angka){ 
                $hasil =  number_format($angka,0, ',' , '.'); 
                return $hasil; 
            }

            foreach ($ProductData as $post) {

                if($post["isArchived"] == true){
                    $status = 'checked';
                }else{
                    $status = '';                    
                }


                $data.='<tr>
                    <td>
                         <input type="checkbox" name="data" class="selectBox" value="'.$post['gdnSku'].'"/>
                    </td>
                    <td>
                        <img src="'.$post['image'].'" width="50px">
                    </td>
                    <td><b style="text-decoration:none; color: #051946; font-size: 12px">'.$post['productName'].'</b> <br>SKU : '.$post['merchantSku'].'</td>
                    <td>Rp. '.format_uang($post['regularPrice']).'</td>
                    <td align="center">'.$post['stockAvailableLv2'].'</td>
                    <td align="center">
                        <input type="checkbox" id="switch1" switch="none" '.$status.' disabled>
                        <label for="switch1" data-on-label="" data-off-label=""></label>
                    </td>
                    </tr>';
            }
            // dd($data);
            return $data;
        }


        return view('blibli.index');       
    }

    public function VupdateWH()
    {   
        $page = 1;
        return view('blibli.update-wh', compact('page'));
    }


    public function productSelUpdateBlibli(Request $request)
    {   
        $ALL = $request->data;
        $persenharga = $request->persenharga;
        $Dikali = floatval(str_replace(',', '.', $persenharga)); //convert to float
      
                // dd($ALL);
        foreach ($ALL as $sku) {
            // endp get info product
            $ENDP = 'https://api.blibli.com/v2/proxy/mta/api/businesspartner/v1/product/detailProduct';
    
            $response = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
                ->withHeaders([
                    'Api-Seller-Key' => 'BEB7A4CFEECA91E38948327F38ECF6B110768F664E49AE734957E4554E3828E7',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ])->get($ENDP.'?'.http_build_query([
                                    'requestId' => 'eb20408b-dd59-4cbc-9979-ff50ab54d98b',
                                    'businessPartnerCode' => 'HOM-60047',
                                    'gdnSku'    => $sku,
                                    'channelId' => 'Honda Mitra Jaya Group'             
                                ]))->json();
            
            // dd($response);
            $harga = $response['value']['items'][0]['prices'][0]['price'];
            // perhitungan
            $HASILPERSEN= $harga * $Dikali / 100;
            
            if($request->aksiharga == 'naik'){
                $HARGAFIX   = $harga + $HASILPERSEN;                
            }else{
                $HARGAFIX   = $harga - $HASILPERSEN;
            }

            $HARGAFIX   = (int)$HARGAFIX;
            //echo $HARGAFIX.'<br>';

            $body = array(
                        'price' => array(
                            'regular'   => $HARGAFIX,
                            'sale'      => $HARGAFIX
                        )
                    );
            dd($body);
            //update
            $ENDP = 'https://api.blibli.com/v2/proxy/seller/v1/products/'.$sku;
            $response = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
                ->withBody(json_encode($body), 'application/json')
                ->withHeaders([
                    'Api-Seller-Key' => 'BEB7A4CFEECA91E38948327F38ECF6B110768F664E49AE734957E4554E3828E7',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ])->put($ENDP.'?'.http_build_query([
                            'blibliSku' => $sku,
                            'requestId' => 'eb20408b-dd59-4cbc-9979-ff50ab54d98b',
                            'storeId'   => '10001',
                            'channelId' => 'Honda Mitra Jaya Group',                
                            'username'  => 'h.mitrajaya@gmail.com',
                            'storeCode' => 'HOM-60047',
                        ])
                )->status();

            $a++;
        }
    }

    public function updateStockPrice(Request $request)
    {

        if ($request->page != Null) {
            // ENDPOINT SHOW DATA BLIBLI

            $page = $request->page-1 ;
            $ENDP = 'https://api.blibli.com/v2/proxy/mta/api/businesspartner/v2/product/getProductList';
            $body = array(
                            'size'  => 5, //max 100
                            'page'  => $page,
                        );
            
            $response = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
                ->withBody(json_encode($body), 'application/json')
                ->withHeaders([
                    'Api-Seller-Key' => 'BEB7A4CFEECA91E38948327F38ECF6B110768F664E49AE734957E4554E3828E7',
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ])->post($ENDP.'?'.http_build_query([
                                    'requestId' => 'eb20408b-dd59-4cbc-9979-ff50ab54d98b',
                                    'businessPartnerCode' => 'HOM-60047',
                                    'username'  => 'h.mitrajaya@gmail.com',
                                    'channelId' => 'Honda Mitra Jaya Group'             
                                ]))->json();
            $ProductData = $response['content'];

            // dd($ProductData);
            // ---------------------------------------------------------------
            if ($ProductData == null) {
                $page = $page+1;
                $jumsukses = null;
                $datagagal = null;
                $pesan = 'Proses Selesai !';
                

            }else{

                $datagagal = [];
                $Harga = [];
                $stok = 0;

                // GET BASIC TOKEN TOKPED
                $BASIC = 'Basic ZWI0MThhMTA5YWJhNDkyYmE3ZmRmOTA4Y2QwNGE0ZmI6ZjU3NmExZjkxM2NiNDM5MzgxZjNlOGZiZmNmYmUzMmE=';
                $URL    = 'https://accounts.tokopedia.com/token';
                $response = Http::withHeaders([
                        'Authorization' => $BASIC
                    ])->post($URL.'?'.http_build_query([
                                'grant_type' => 'client_credentials',                  
                            ]))->json();
                $TOKEN = $response['access_token'];
                $BEARER = $TOKEN;

                foreach ($ProductData as $sku) {                                

                    // ENDP SHOW DATA TOKPED BY SKU
                    $URL    = 'https://fs.tokopedia.net/inventory/v1/fs/14130/product/info';
                    $response2 = Http::withToken($BEARER)->get($URL,[
                            'fs_id' => '14130',
                            'sku'   => $sku['merchantSku'],
                        ]);

                    $respon = $response2->json();
                    dd($respon);
                    if ($response2->status() == 200) {
                        
                        $res3 = $respon['data'];
                        foreach ($res3 as $key) {
                            // dd($key);
                            $stok = 0;
                            if (isset($key['stock']['value'])) {
                                $stok = $key['stock']['value'];
                            }

                            $x[] = array(
                                    'gdnSku'    => $sku['gdnSku'],
                                    'sku'  => $sku['merchantSku'],
                                    'harga'     => $key['price']['value'],
                                    'stok'      => $stok
                                );  
                            $databerhasil[] =  $sku['productSku'];
                        }                        
                    }else{
                        $datagagal[] =  $sku['productSku'];
                    }
                }
                // dd($x, $datagagal);
                foreach ($x as $z) {
                                
                    $body = array(
                                'availableStock' => $z['stok']
                            );
                    // dd($body);

                    $header = array(
                                'Api-Seller-Key' => 'BEB7A4CFEECA91E38948327F38ECF6B110768F664E49AE734957E4554E3828E7',
                                'Accept'        => 'application/json',
                                'Content-Type'  => 'application/json'
                            );

                    $builder = array(
                                'blibliSku' => $z['gdnSku'],
                                'requestId' => 'eb20408b-dd59-4cbc-9979-ff50ab54d98b',
                                'storeId'   => '10001',
                                'channelId' => 'Honda Mitra Jaya Group',                
                                'username'  => 'h.mitrajaya@gmail.com',
                                'storeCode' => 'HOM-60047'
                            );

                    $harga_str  = preg_replace("/[^0-9]/", "", $z['harga']);
                    $NEW_PRICE  = (int)$harga_str;
                    if ($z['stok'] > 0) {
                            
                        $body2 = array(
                                    'buyable' => true,
                                    'price' => array(
                                        'regular'   => $NEW_PRICE,
                                        'sale'      => $NEW_PRICE
                                    ),
                                    'sellerSku'=> $sku['merchantSku'],
                                    'displayable'=> true,
                                );
                    }else{
                        $body2 = array(
                                    'buyable' => false,
                                    'price' => array(
                                        'regular'   => $NEW_PRICE,
                                        'sale'      => $NEW_PRICE
                                    ),
                                    'displayable'=> false,
                                );
                    }   
                    // dd($z['sku'], $body2);
                    // ENDP UPDATE STOCK BLIBLI
                    $ENDP = 'https://api.blibli.com/v2/proxy/seller/v1/products/'.$z['gdnSku'].'/stock';
                    
                    $responStok[] = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
                        ->withBody(json_encode($body), 'application/json')
                        ->withHeaders($header)
                        ->put($ENDP.'?'.http_build_query($builder))
                        ->status();
                    
                    // ENDP UPDATE HARGA BLIBLI
                    $ENDP2 = 'https://api.blibli.com/v2/proxy/seller/v1/products/'.$z['gdnSku'];
                
                    $responHarga[] = Http::withBasicAuth('mta-api-HOM-60047-114d1','mta-api-oPKO9Dt5tvUK3kaUgEQpvIUHCqLqpK7wCIPLRqih8C1HC1FY3B')
                        ->withBody(json_encode($body2), 'application/json')
                        ->withHeaders($header)
                        ->put($ENDP2.'?'.http_build_query($builder))
                        ->json();
                }

                dd($databerhasil, $responStok, $responHarga);
                $dataG = '';
                foreach ($datagagal as $key) {
                     $dataG.='<li>'.$key.'</li>';
                }

                $dataB = '';
                foreach ($databerhasil as $key) {
                     $dataB.='<li>'.$key.'</li>';
                }

       
                $jumsukses = count($responStok);

                return response()->json([
                    'success'   => true,
                    'message'   => 'Permintaan berhasil diproses !',
                    'jumsukses' => $jumsukses,
                    'datagagal' => $dataG,
                    'databerhasil'=> $dataB,
                    'page'      => $request->page + 1,
                ]);
            }           
        }else{
            $page = 1;
            $jumsukses = null;
            $dataG = null;
            $dataB = null;

            return response()->json([
                'success'   => false,
                'message'   => 'Permintaan gagal diproses !',
                'jumsukses' => $jumsukses,
                'databerhasil'=> $dataB,
                'datagagal' => $dataG,
                'page'      => $page,
            ]);
        }
    }
}
