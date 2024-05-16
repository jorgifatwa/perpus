<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Book;
use App\Models\BukuMasuk;
use App\Models\BukuKeluar;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function index(){
        return view('auth.login');
     }

     public function register(){ 
        return view('auth.register'); 
     }

     public function proses_login(Request $request){

        // isi credential hanya berupa username dan password
        $credentials =  $request->only('email','password');
        //validasi menggunakan Illuminate\Support\Facades\Validator
        //isi field validasi dan rules nya yaitu wajib di isi
        $validate = Validator::make($credentials,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        // jika terdapat field yang kosong
        if($validate->fails()){
            //kembali ke halaman login & tampilkan error pada setiap inputnya
            return back()->withErrors($validate)->withInput();
        }

        // verifikasi data user pada kolom email dan password sesuai atau belum
        if(Auth::attempt($credentials)){
            //jika sesuai maka jalankan fungsi dashboard
            return redirect()->intended('dashboard')->with('success','Successfully Login');
        }
        // kembali ke halaman login dan tampilkan pesan error pada login_error
        return redirect('login')->withInput()->withErrors(['login_error'=>'Username or password are wrong!']);
      }

      public function dashboard(){ 
        //  cek berhasil login 
        if(Auth::check()){
            // menampilkan total data 
            $totalAnggota = Anggota::all()->count();
            $totalBook = Book::all()->count();
            $totalPinjam = Pinjam::all()->count();
            $totalPinjamLaki = Pinjam::join('anggota', 'pinjam.anggota_id', '=', 'anggota.anggota_id')
            ->where('gender', 'male')
            ->count();  
            $totalPinjamCewe = Pinjam::join('anggota', 'pinjam.anggota_id', '=', 'anggota.anggota_id')
            ->where('gender', 'female')
            ->count();  
            $totalQuantityMasuk = BukuMasuk::sum('quantity');
            $totalQuantityKeluar = BukuKeluar::sum('quantity');
            return view('home',compact('totalAnggota','totalBook','totalPinjam','totalPinjamLaki','totalPinjamCewe','totalQuantityMasuk','totalQuantityKeluar'));

        }

        return redirect('login')->with('You dont have access');
      }

      public function proses_register(Request $request){
        //validasi menggunakan Illuminate\Support\Facades\Validator
        //isi field validasi dan rules nya yaitu wajib di isi
        $validate = Validator::make($request->all(),[
            'fullname'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
            
        
        // jika terdapat field yang kosong
        if($validate->fails()){
            //kembali ke halaman login & tampilkan error pada setiap inputnya
            return back()->withErrors($validate)->withInput();
        }

        // tambahkan field level dan kita isi dengan admin
        $request['level'] = 'admin';
//      panggil model User dan jalankan fungsi ORM create untuk melakukan insert semua data
        User::create($request->all());

        return redirect('dashboard')->with('success','You have successfully register');


       }

       public function logout(){
        //  clear session dan memberitahu auth dengan status logout
            Session::flush();
            Auth::logout();

            return Redirect('login');
        }
}