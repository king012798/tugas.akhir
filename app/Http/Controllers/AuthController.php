<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function ShowFormLogin()
    {
        if (Auth::check()){ // true sekalian session field di users nanti 
        //login sukses
        return redirect ()->route('home'); 
        }
        return view ('login');
    }

    public function login (Request $request)
    {
        $rules =[
            'email' => 'required|email',
            'password' => 'required|string'
        ];
        $messages =[
            'email.required' => 'email tidak wajid',
            'email.email' => 'email tidak valid',
            'password.required' => 'password wajid diisi',
            'password.string' => 'password harus berupa string'
        ];

        $validator = Validator :: make($request->all(), $rules, $messages);
        if ($validator-> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check ()) { // true sekalian session field di user nanti bisa di panggil viA Auth
            // login sukses
            return redirect()->route('home');

        } else { //false
            //Login Fail
            Session::false('error','email atau password salah');
            return redirect()->route('login');
        }
    }
    public function ShowFormRegister ()
    {
        return view ('register');
    }
    public function register( Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ];

        $messages = [
            'name.required' => 'Nama lengkap wajib diisi',
            'name.min' => 'nama lengkap minimal 3 karakter',
            'name.max' => 'nama lengkap maximal 35 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'password wajid diisi',
            'password.confirmed' => 'password tidak sama dengan konfirmasi'
        ];

        $validator = Validator:: make($request->all(), $rules,$messages);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $user = new User;
        $user-> name = ucwords(strtolower($request-> name));
        $user-> email = strtolower($request-> email);
        $user-> password = Hash::make($request-> password);
        $user-> email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
        
        if ($simpan){
            Session::flash('succes', 'Register berhasil silahkan login untuk mengakses data');
            return redirect()->route('login');
        }else {
            Session::flash('errors', [''=>'Register gagal! silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }
    public function logout()
    {
        Auth::logout(); //menghapus session yang aktif
        return redirect()->route('login');
    }
}
