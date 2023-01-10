<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use DateTime;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Fetch Client information 
    public function clientlist(Request $request)
    {
        $data = $request->all();
        $territory_id = $data['select_territory_id'];
        if(isset($data['searchTerm']) && $data['searchTerm']!=''){
            $searchTerm = str_replace(' ', '%20', $data['searchTerm']);    
        }else{
            $searchTerm = "";
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientlist.php?territory_id='.$territory_id.'&searchTerm='.$searchTerm,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        $text = "";
        foreach($response as $user){
            if(isset($user["location"]) && $user["location"] != ""){
                $text .= "[";
                $text .= ( !is_null( $user["location"] ) ? $user["location"] : "Unspecified" ); 
                $text .= "] ";    
            }
            $value_output = stripslashes( $user[ "company" ]);
            $text .= substr($value_output, 0, 50) . (strlen($value_output) > 50 ? "..." : "");
            if ($user['setup_id'] == 11) {
                $text .= " (Corporate)";
            }                  
           $response[] = array(
              "id" => $user['id'],
              "text" => $text
           );
           $text = "";
        }
        return response()->json($response);
    }
    //Fetch Client wise contact list information 
    public function contactlist(Request $request)
    {
        $data = $request->all();
        $clientid = $data['clientid'];
        if(isset($data['searchTerm']) && $data['searchTerm']!=''){
            $searchTerm = str_replace(' ', '%20', $data['searchTerm']);    
        }else{
            $searchTerm = "";
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientcontactlist.php?client_id='.$clientid.'&searchTerm='.$searchTerm,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response,true);
        $text = "";
        foreach($response as $user){
            if(isset($user["company"]) && $user["company"] != ""){
                $text .= "[";
                $text .= ( !is_null( $user["company"] ) ? $user["company"] : "Unspecified" ); 
                $text .= "] ";    
            }

           $response[] = array(
              "id" => $user['id'],
              "text" => $user['first']." ".$user['last'].$text
           );
           $text = "";
        }

        return response()->json($response);
    }

    //Fetch Client and contact wise Location list information 
    public function contactlocation(Request $request)
    {
        $data = $request->all();
        $contactid = $data['contactid'];
        $clientid = $data['clientid'];
        if(isset($data['searchTerm']) && $data['searchTerm']!=''){
            $searchTerm = str_replace(' ', '%20', $data['searchTerm']);    
        }else{
            $searchTerm = "";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientlocation.php?client_id='.$clientid.'&searchTerm='.$searchTerm,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        foreach($response as $user){
           $response[] = array(
              "id" => $user['id'],
              "text" => $user['street_address']
           );
        }
        return response()->json($response);
    }
    //Fetch ItemType information 
    public function clientiteamtype(Request $request)
    {
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $territory_id = $data['select_territory_id'];
        $item_type_id = $data['select_item_type_id'];

        $url = env('API_URL_API').'API/clientAssetAjax.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;    

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        foreach($response as $user){
           $response[] = array(
              "id" => $user['id'],
              "text" => $user['value']
           );
        }
        return response()->json($response);
    }
    //Get Estimate Propsal
    public function getEstimateProposal(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $territory_id = $data['select_territory_id'];
        $item_type_id = $data['select_item_type_id'];
        $url = env('API_URL_API').'API/listestimation.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;
      
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        
        return  Datatables::of($response)->make(true);
    } 

    //Get listmeter Propsal
    public function listmeter(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $territory_id = $data['select_territory_id'];
        $item_type_id = $data['select_item_type_id'];

        $url = env('API_URL_API').'API/listemeter.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;    
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    } 

    //Get listmetercount Propsal
    public function listmetercount(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $territory_id = $data['select_territory_id'];
        $item_type_id = $data['select_item_type_id'];

        $url = env('API_URL_API').'API/listmetercount.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;    
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    } 

    //Get GoogleMap 
    public function getGoogleMap(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $territory_id = $data['select_territory_id'];
        $item_type_id = $data['select_item_type_id'];
        
        $url = env('API_URL_API').'API/listestimation.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;    

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    } 

    //Get BarChart Data 
    public function getBarChart(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $item_type_id = $data['select_item_type_id'];
        $territory_id = $data['select_territory_id'];
        
        $url = env('API_URL_API').'API/listestimationcount.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        /*// Initialize output array...
        $out = array();

        // Looping over each input array item
        foreach ($response as $elem) {
            $est_date = $elem['est_date'];
            $time=strtotime($est_date);
            $month=date("m",$time);
            $year=date("Y",$time);
            // Initialize a new element in the output keyed as yyyy-mm-dd if it doesn't already exist
            if (!isset($out[$month])) {
                $out[$month] = array(
                  // With the current value...
                  'total' => $elem['total'],
                  'months' => $month,
                );
            }
            // If it already exists, just add the current value onto it...
            else {
                $out[$month]['total'] += $elem['total'];
            }
        }
        // Now your output array is keyed by date.  Use array_values() to strip off those keys if it matters:
        $out = array_values($out);
        usort($out, function($a, $b) {
            return $a['months'] <=> $b['months'];
        });*/

        $data = json_encode($response,true);
        return response()->json($data);
    } 

    //Get BarChart Data 
    public function getBarChartTotalRevenue(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $item_type_id = $data['select_item_type_id'];
        $territory_id = $data['select_territory_id'];
        
        $url = env('API_URL_API').'API/listTotalRevenueCount.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        $data = json_encode($response,true);
        return response()->json($data);
    }

    //Get Total Revenue
    public function getTotalRevenue(Request $request){
        $data = $request->all();
        $territory_id = $data['select_territory_id'];
        $clientid = $data['clientid'];
        $url=env('API_URL_API').'API/totalRevenue.php?client_id='.$clientid.'&territory_id='.$territory_id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    }
    //Get Total Assets
    public function getTotalAsset(Request $request){
        $data = $request->all();
        $territory_id = $data['select_territory_id'];
        $clientid = $data['clientid'];
        $url = env('API_URL_API').'API/totalassetscount.php?client_id='.$clientid.'&territory_id='.$territory_id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    }

    //Get Total Revenue Specific Asset
    public function getTotalRevenueT(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $item_type_id = $data['select_item_type_id'];
        $territory_id = $data['select_territory_id'];
        $url = env('API_URL_API').'API/totalRevenueT.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    }
    //Get Total Assets specific Asset
    public function getTotalAssetT(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $item_type_id = $data['select_item_type_id'];
        $territory_id = $data['select_territory_id'];
        $url = env('API_URL_API').'API/totalassetscountT.php?territory_id='.$territory_id.'&client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&item_type_id='.$item_type_id.'&start_date='.$startdate.'&end_date='.$enddate;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return response()->json($response);
    }
}