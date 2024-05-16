<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BukuMasuk;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class BukuMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data last lalu bagi menjadi 5 data setiap page
        $buku_masuk =  BukuMasuk::join('book','buku_masuk.book_id','=','book.book_id')->select([ 'book.title as title','buku_masuk.created_at','buku_masuk.quantity'])->paginate(5);
        // kembalikan halaman view buku_masuk list dengan mengirim datanya
        return view('buku_masuk_list',compact('buku_masuk'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book =  Book::all();
        //tampilkan halaman add anggota
        return view('buku_masuk_add',compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Menjalankan fungsi insert pada table buku masuk 
            $bukuMasuk = BukuMasuk::create($request->all());
            
            // Mendapatkan buku yang masuk berdasarkan ID
            $buku = Book::findOrFail($request->buku_id);
            
            // Menambahkan stok buku yang masuk ke stok total
            $buku->stock += $request->quantity;
            $buku->save();

            // Redirect ke halaman list buku masuk
            return redirect()->route('buku_masuk.index')->with('success','Successfully created new buku masuk');
        } catch (\Throwable $th) {
            // Munculkan pesan error jika ada error
            return redirect()->route('buku_masuk.index')->with('error', $th->getMessage());
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
        //munculkan data buku keluar sesuai parameter id dan ambil satu data
        $buku_masuk =  BukuMasuk::where('buku_masuk_id',$id)->firstOrFail();
        $book =  Book::all();
        // jika ada data anggota
        if($buku_masuk){
            // buka halaman view buku_masuk dengan mengirim datanya
            return view('buku_masuk_edit',compact('buku_masuk','book'));
        }else{
            return redirect()->route('buku_masuk.index')->with('error','buku keluar not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //tambahkan validasi
        //ambil data buku keluar sesuai parameter id dan lakukan update pada modelnya
        BukuMasuk::where('buku_masuk_id',$id)->update([
            'created_at'=> $request->fullname,
            'quantity'=> $request->quantity,
        ]);


        return redirect()->route('buku_masuk.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //lakukan delete pada data anggota sesuai parameter id
        BukuMasuk::where('buku_masuk_id',$id)->delete();

        return redirect()->route('buku_masuk.index')->with('success','Successfully delete data');
    }

    public function getBukuMasukById(Request $request){
       
      //ajax akan meminta request untuk mengambil data anggota berdasarkan parameter
        $buku_masuk =  BukuMasuk::where('buku_masuk_id',$request->id)->firstOrFail();
        // kembalikan data dalam bentuk response json
        return response()->json([
            'buku_masuk'=>$buku_masuk
        ]);
     }
}