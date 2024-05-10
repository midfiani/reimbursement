<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
         // kita ambil data user lalu simpan pada variable $user
         $user = Auth::user();
         // kondisi jika user nya ada 
         if($user){
             
            // jika user nya memiliki level direk
             if($user->level =='DIREKTUR'){
                //  ke halaman DIREKTUR
                 return redirect()->intended('DIREKTUR');
             }
            // jika user nya memiliki level finance
             else if($user->level =='FINANCE'){
                //  ke halaman FINANCE
                 return redirect()->intended('FINANCE');
             }
            // jika user nya memiliki level staf
             else if($user->level =='STAFF'){
                //  ke halaman staff
                 return redirect()->intended('STAFF');
             }
 
         }

         return view('auth.login');
    }

    public function proses_login(Request $request){
        /* buat validasi pada saat tombol login di klik */

        // validasi nya nip & password wajib di isi 
        $request->validate([
            'nip'=>'required|numeric|min:2',
            'password'=>'required'
        ]);


        // ambil data request nip & password saja 
        $credential = $request->only('nip','password');

        // cek jika data NIP dan password valid (sesuai) dengan data
        if(Auth::attempt($credential)){
            // kalau berhasil simpan data user ya di variabel $user
            $user =  Auth::user();
            // cek lagi jika level user admin maka arahkan ke halaman DIREKTUR
            if($user->level =='DIREKTUR'){
                return redirect()->intended('DIREKTUR');

            }
                // tapi jika level user nya user biasa maka arahkan ke halaman FINANCE
                else if($user->level =='FINANCE'){
                return redirect()->intended('FINANCE');
            }
                // tapi jika level user nya user biasa maka arahkan ke halaman STAF
            else if($user->level =='STAFF'){
                return redirect()->intended('STAFF');
            }
            // jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }

        // jika ga ada data user yang valid maka kembalikan lagi ke halaman login
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal'=>'These credentials does not match our records']);

    }

    public function logout(){
    //  clear session dan memberitahu auth dengan status logout
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
