<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class AdminController extends Controller
{
    // Admin login function
    function login(Request $req){

        // Validate the incoming request
        $validate = $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);


        // Check if admin exists with given credentials
        $admin = Admin::where([
            ['name', '=', $req->name],
            ['password', '=', $req->password]
        ])->first();

        if(!$admin){
            return back()->withErrors([
                'user' => 'User Does Not Exist! Please Check Your Credientials Again.'
            ]);
        }

        Session::put('admin', $admin);
        return redirect('admin-dashboard');
    }


    // Admin dashboard function
    function dashboard(){
        $admin = Session::get('admin');
        if($admin){
            return view('admin-dashboard', ["name" => $admin->name]);
        }else{
            return redirect('admin');
        }
    }

}