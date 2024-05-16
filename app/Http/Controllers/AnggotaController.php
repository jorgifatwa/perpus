<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data last lalu bagi menjadi 5 data setiap page
        $anggota =  Anggota::join('kelas','anggota.kelas_id','=','kelas.kelas_id')->select([ 'anggota.anggota_id','anggota.fullname','anggota.email','anggota.gender','anggota.phone','anggota.address','kelas.name as kelas_name'])->paginate(5);
        // kembalikan halaman view anggota list dengan mengirim datanya
        return view('anggota_list',compact('anggota'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas =  Kelas::all();
        //tampilkan halaman add anggota
        return view('anggota_add',compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            // menjalankan fungsi insert pada table anggota 
            Anggota::create($request->all());
            // redirect ke halaman list anggota
            return redirect()->route('anggota.index')->with('success','Successfully to create new anggota');
        } catch (\Throwable $th) {
            //throw $th;
           // munculkan pesan error jika ada error
            return redirect()->route('anggota.index')->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //munculkan data anggota sesuai parameter id dan ambil satu data
        $anggota =  Anggota::where('anggota_id',$id)->firstOrFail();
        $kelas =  Kelas::all();
        // jika ada data anggota
        if($anggota){
            // buka halaman view anggota_edit dengan mengirim datanya
            return view('anggota_edit',compact('anggota','kelas'));
        }else{
            return redirect()->route('anggota.index')->with('error','anggota not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //tambahkan validasi
        //ambil data anggota sesuai parameter id dan lakukan update pada modelnya
        Anggota::where('anggota_id',$id)->update([
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'kelas_id'=> $request->kelas_id
        ]);


        return redirect()->route('anggota.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //lakukan delete pada data anggota sesuai parameter id
        Anggota::where('anggota_id',$id)->delete();

        return redirect()->route('anggota.index')->with('success','Successfully delete data');
    }

    public function getAnggotaById(Request $request){
       
      //ajax akan meminta request untuk mengambil data anggota berdasarkan parameter
        $anggota =  Anggota::where('anggota_id',$request->id)->firstOrFail();
        // kembalikan data dalam bentuk response json
        return response()->json([
            'anggota'=>$anggota
        ]);
     }
}