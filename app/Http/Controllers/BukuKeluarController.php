<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BukuKeluar;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class BukuKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data last lalu bagi menjadi 5 data setiap page
        $buku_keluar =  BukuKeluar::join('book','buku_keluar.book_id','=','book.book_id')->select([ 'book.title as title','buku_keluar.created_at','buku_keluar.quantity'])->paginate(5);
        // kembalikan halaman view buku_keluar list dengan mengirim datanya
        return view('buku_keluar_list',compact('buku_keluar'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book =  Book::all();
        //tampilkan halaman add buku_keluar
        return view('buku_keluar_add',compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menjalankan validasi untuk memeriksa stok buku
        $book = Book::findOrFail($request->book_id); // Menggunakan model buku yang Anda miliki, ganti dengan model yang sesuai
        if ($book->stock < $request->quantity) {
            return redirect()->route('buku_keluar.index')->with('error', 'Stock not enough');
        }

        try {
            // Menjalankan fungsi insert pada table buku keluar
            BukuKeluar::create($request->all());
            // Mengurangi stok buku yang keluar dari stok total
            $book->stock -= $request->quantity;
            $book->save();

            // Redirect ke halaman list buku keluar
            return redirect()->route('buku_keluar.index')->with('success','Successfully created new buku keluar');
        } catch (\Throwable $th) {
            // Munculkan pesan error jika ada error
            return redirect()->route('buku_keluar.index')->with('error', $th->getMessage());
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
        $buku_keluar =  BukuKeluar::where('buku_keluar_id',$id)->firstOrFail();
        $book =  Book::all();
        // jika ada data anggota
        if($buku_keluar){
            // buka halaman view buku_keluar dengan mengirim datanya
            return view('buku_keluar_edit',compact('buku_keluar','book'));
        }else{
            return redirect()->route('buku_keluar.index')->with('error','buku keluar not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //tambahkan validasi
        //ambil data buku keluar sesuai parameter id dan lakukan update pada modelnya
        BukuKeluar::where('buku_keluar_id',$id)->update([
            'created_at'=> $request->fullname,
            'quantity'=> $request->quantity,
        ]);


        return redirect()->route('buku_keluar.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //lakukan delete pada data anggota sesuai parameter id
        BukuKeluar::where('buku_keluar_id',$id)->delete();

        return redirect()->route('buku_keluar.index')->with('success','Successfully delete data');
    }

    public function getBukuKeluarById(Request $request){
       
      //ajax akan meminta request untuk mengambil data anggota berdasarkan parameter
        $buku_keluar =  BukuKeluar::where('buku_keluar_id',$request->id)->firstOrFail();
        // kembalikan data dalam bentuk response json
        return response()->json([
            'buku_keluar'=>$buku_keluar
        ]);
     }
}