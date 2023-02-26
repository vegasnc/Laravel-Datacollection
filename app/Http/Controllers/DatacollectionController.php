<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Datacollection;
use App\Models\Asset;
use Carbon\Carbon;
use Storage;

class DatacollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = datacollection::all();
    
        return view('admin.datacollection.index',compact('users'));
            // ->with('i', (request()->input('page', 1) - 1) * 5)
            // return view('admin.datacollection');
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataform()
    {
        $asset = asset::all();
        return view('admin.datacollection.create',compact('asset'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataadd(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
        $data = $request->all();
        $base64_str = substr($data['photo'], strpos($data['photo'], ",")+1);
        $image = base64_decode($base64_str);
        $current_date_time = Carbon::now()->timestamp;
        $safeName = $current_date_time.'.'.'png';    
        Storage::disk('public')->put('dist/img/photo/'.$safeName, $image);
        $data = $request->all(); 
        $data['photo'] = $safeName;

        if(isset($data['addnewasset']) && $data['addnewasset'] != ""){
            $array_new_asset = array(
                'name'=>$data['addnewasset'],
            );
            Asset::create($array_new_asset);
            $data['asset'] = $data['addnewasset'];
            $user = Datacollection::create($data);
        }else{
            $user = Datacollection::create($data);
        }
        

        if ($user) {
            return redirect()->route('datacollection')->with('success', 'Data created successfully.');
        }
        else {
            return redirect()->route('datacollection')->with('failed', 'Failed! Data not created');
        }
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.datacollection.show',compact('user'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function dataedit($id)
    {   
        $asset = asset::all();
        $user = DB::table('datacollection')->where('id', $id)->first();
        return view('admin.datacollection.edit',compact('user','asset'));
    }
    function is_base64($str)
    {
        return (bool)preg_match('`^[a-zA-Z0-9+/]+={0,2}$`', $str);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function dataupdate(Request $request, Datacollection $user,$id)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
        
        $data = $request->all();
        
        

        $base64_str = substr($data['photo'], strpos($data['photo'], ",")+1);
        if($this->is_base64($base64_str) == true){
            $image = base64_decode($base64_str);
            $current_date_time = Carbon::now()->timestamp;
            $safeName = $current_date_time.'.'.'png';    
            Storage::disk('public')->put('dist/img/photo/'.$safeName, $image);
        }else{
            $safeName = $data['photo'];   
        }
        

        $array_data = array(
            "asset" => $data['asset'],
            "address" => $data['address'],
            "quantity" => $data['quantity'],
            "condition" => $data['condition'],
            "tagged" => $data['tagged'],
            "color" => $data['color'],
            "latitude" => $data['latitude'],
            "longitude" => $data['longitude'],
            "description" => $data['description'],
            "photo" => $safeName,
        );
        
        
       
        if(isset($data['addnewasset']) && $data['addnewasset'] != ""){
            $array_new_asset = array(
                'name'=>$data['addnewasset'],
            );
            Asset::create($array_new_asset);
            $array_data['asset'] = $data['addnewasset'];
            Datacollection::where('id', $id)->update($array_data);
        }else{
            Datacollection::where('id', $id)->update($array_data);
        }

        if ($user) {
            return redirect()->route('datacollection')->with('success', 'Data edited successfully.');
        }
        else {
            return redirect()->route('datacollection')->with('failed', 'Failed! Data not edited');
        }                        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('datacollection')->where('id', $id)->delete();

        if ($delete) {
            return redirect()->route('datacollection')->with('success', 'Data deleted successfully.');
        }
        else {
            return redirect()->route('datacollection')->with('failed', 'Failed! Data not deleted');
        }
    }
}