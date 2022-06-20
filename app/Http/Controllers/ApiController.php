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
        $response = json_decode(file_get_contents(env('API_URL_API').'API/clientlist.php'), true);
       // dd($json);
        /*$curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientlist.php',
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
        $response = json_decode($response,true); */
        return response()->json($response);
    }
    //Fetch Client wise contact list information 
    public function contactlist(Request $request)
    {
        $data = $request->all();
        $clientid = $data['clientid'];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientcontactlist.php?client_id='.$clientid,
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

    //Fetch Client and contact wise Location list information 
    public function contactlocation(Request $request)
    {
        $data = $request->all();
        $contactid = $data['contactid'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => env('API_URL_API').'API/clientlocation.php?contact_id='.$contactid,
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
    //Get Estimate Propsal
    public function getEstimateProposal(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $itemtype = $data['itemtype'];
        $search = $data['search'];

        if($search == null){
            //$url = env('API_URL_API').'/API/listestimation.php?client_id=28585&location_id=123580&contact_id=54927&start_date=2020-05-14&end_date=2022-06-14&search='.$search;
            $url = env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate.'&search='.$search;
        }else{
            //$url = env('API_URL_API').'/API/listestimation.php?client_id=28585&location_id=123580&contact_id=54927&start_date=2020-05-14&end_date=2022-06-14';
            $url = env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate;    
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
          //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate.'&itemtype='.$itemtype,
        //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate,
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

    //Get GoogleMap 
    public function getGoogleMap(Request $request){
        $data = $request->all();
        $select_cl_id = $data['select_cl_id'];
        $select_location_id = $data['select_location_id'];
        $select_contact_id = $data['select_contact_id'];
        $startdate = $data['startdate'];
        $enddate = $data['enddate'];
        $itemtype = $data['itemtype'];

        
        //$url = env('API_URL_API').'/API/listestimation.php?client_id=28585&location_id=123580&contact_id=54927&start_date=2020-05-14&end_date=2022-06-14';
         
        $url = env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate;    

        $curl = curl_init();

        curl_setopt_array($curl, array(
          //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate.'&itemtype='.$itemtype,
        //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate,
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
        $itemtype = $data['itemtype'];

        
        //$url = env('API_URL_API').'/API/listestimation.php?client_id=28585&location_id=123580&contact_id=54927&start_date=2020-05-14&end_date=2022-06-14';
        
        $url = env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate.'&itemtype='.$itemtype,
        //CURLOPT_URL => env('API_URL_API').'/API/listestimation.php?client_id='.$select_cl_id.'&location_id='.$select_location_id.'&contact_id='.$select_contact_id.'&start_date='.$startdate.'&end_date='.$enddate,
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

        // Initialize output array...
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
        });
        $out = json_encode($out);
        return response()->json($out);
    } 
}