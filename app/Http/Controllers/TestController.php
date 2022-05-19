<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class TestController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.test');
    }

    public function users(){
        $users = getUsers();
        $data_array = json_decode($users);
        return $data_array->result;
    }


     public function createUsers(Request $request)
    {
        $data = $request->all();
        dd($data);

        //return response()->json(getEnvsByUserId($data["created_by"]));
    }
}