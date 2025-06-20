<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function authenticate(Request $request) {
    $validator = Validator::make($request->all(),[
       'email' => 'required|email',
    'password' => 'required',
], [
    'email.required' => 'Email wajib diisi.',
    'password.required' => 'Password tidak boleh kosong.',
]);

    if($validator->passes()){

        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->Route('account.dashboard');
        } else{
            return redirect()->route('account.login')->with('error','Gmail atau Kata sandi salah
            ');
        }

    } else {
        return redirect()->Route('account.login')
        ->withInput()
        ->withErrors($validator);
    }

    }

    public function register(){
        return view('register');

    }

    public function processregister(Request $request) {

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'name' => 'required',
            'password_confirmation' => 'required',

         ]);

         if($validator->passes()){

           $user = new User();
           $user->name =$request->name;
           $user->email =$request->email;
           $user->password = Hash::make($request->password);
           $user->role = 'customer';
           $user->save();

            return redirect()->Route('account.login')->with('success','you have successfully registered.');


         } else {
             return redirect()->Route('account.register')
             ->withInput()
             ->withErrors($validator);
         }

    }

    public function logout(){
        Auth::logout();
        return redirect()->Route('account.login')
;
    }

}
