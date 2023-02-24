<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Datacollection;

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
        return view('admin.datacollection.create');
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
            'asset' => 'required',
            'address' => 'required',
            'quantity' => 'required',
            'color' => 'required',
        ]);
    
        $user = Datacollection::create($request->all());
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
        $user = DB::table('datacollection')->where('id', $id)->first();
        return view('admin.datacollection.edit',compact('user'));
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
            'asset' => 'required',
            'address' => 'required',
            'quantity' => 'required',
            'color' => 'required',
        ]);
        
        $data = $request->all();
        
        $array_data = array(
            "asset" => $data['asset'],
            "address" => $data['address'],
            "quantity" => $data['quantity'],
            "condition" => $data['condition'],
            "tagged" => $data['tagged'],
            "color" => $data['color'],
        );
        
        Datacollection::where('id', $id)->update($array_data);

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