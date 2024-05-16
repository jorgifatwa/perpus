<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data last lalu bagi menjadi 5 data setiap page
        $kelas =  Kelas::latest()->paginate(5);
        // kembalikan halaman view kelas list dengan mengirim datanya
        return view('kelas_list',compact('kelas'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            // menjalankan fungsi insert pada table kelas 
            Kelas::create($request->all());
            // redirect ke halaman list kelas
            return redirect()->route('kelas.index')->with('success','Successfully to create new kelas');
        } catch (\Throwable $th) {
            //throw $th;
           // munculkan pesan error jika ada error
            return redirect()->route('kelas.index')->with('error',$th->getMessage());
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
        //munculkan data kelas sesuai parameter id dan ambil satu data
        $kelas =  Kelas::where('kelas_id',$id)->firstOrFail();
        // jika ada data kelas
        if($kelas){
            // buka halaman view kelas_edit dengan mengirim datanya
            return view('kelas_edit',compact('kelas'));
        }else{
            return redirect()->route('kelas.index')->with('error','kelas not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //tambahkan validasi
        //ambil data kelas sesuai parameter id dan lakukan update pada modelnya
        Kelas::where('kelas_id',$id)->update([
            'name'=> $request->name,
        ]);


        return redirect()->route('kelas.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //lakukan delete pada data kelas sesuai parameter id
        Kelas::where('kelas_id',$id)->delete();

        return redirect()->route('kelas.index')->with('success','Successfully delete data');
    }

    public function getKelasById(Request $request){
       
      //ajax akan meminta request untuk mengambil data kelas berdasarkan parameter
        $kelas =  Kelas::where('kelas_id',$request->id)->firstOrFail();
        // kembalikan data dalam bentuk response json
        return response()->json([
            'kelas'=>$kelas
        ]);
     }
}