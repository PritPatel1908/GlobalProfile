<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $data = $request->all();
            $user_data = DB::table('users')
                ->where('email', '=', $data['email'])
                ->first(); // Fetch user data first

            if (is_null($user_data) || !Hash::check($data['password'], $user_data->password)) {
                return redirect()->route('login.index')->with('error', 'Invalid e-mail or password.');
            } else {
                session(['user_email' => $user_data->email]);
                return redirect('employee');
            }
            // $user_data = DB::table('users')
            //     ->where('email', '=', $data['email'])
            //     // ->where('password', '=', Hash::make($data['password']))
            //     ->first();
            // if (is_null($user_data)) {
            //     return redirect()->route('login.index')->with('error', 'Invalid e-mail or password.');
            // } else {
            //     session(['user_email' => $user_data->email]);
            //     return redirect('employee');
            // }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            return redirect()->route('login.index')->with('error', 'Error in checking user data. Please try again.');
        }
    }
}
