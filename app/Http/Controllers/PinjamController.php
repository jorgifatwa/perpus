<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Anggota;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    
    public function index()
    {
        //query join antara tabel anggota,buku dan pinjam
        // setelah joint baru ambil kolom nya pakai fungsi select
        $pinjam =  Pinjam::join('anggota', 'pinjam.anggota_id', '=', 'anggota.anggota_id')
        ->join('book', 'pinjam.book_id', '=', 'book.book_id')
        ->select([
            'pinjam.pinjam_id',
            'pinjam.pinjam_date',
            'pinjam.kembali_date',
            'anggota.fullname',
            'anggota.email',
            'book.title',
            'pinjam.quantity',
            'pinjam.pinjam_status'
        ])
        ->orderBy('pinjam.pinjam_id', 'desc')
        ->paginate(5);    


        return view('pinjam_list',compact('pinjam'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $anggota =  Anggota::all();
        $book = Book::all();
        return view('pinjam_add',compact('anggota','book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::where('book_id', $request->book_id)->first();
        if ($book->stock < $request->quantity) {
            return redirect()->route('pinjam.index')->with('error', 'Stock not enough');
        }

        try {
            // Menjalankan fungsi insert pada table buku keluar
            Pinjam::create($request->all());
            // Mengurangi stok buku yang keluar dari stok total
            $book->stock -= $request->quantity;
            $book->save();

            // Redirect ke halaman list buku keluar
            return redirect()->route('pinjam.index')->with('success','Successfully created new buku keluar');
        } catch (\Throwable $th) {
            // Munculkan pesan error jika ada error
            return redirect()->route('pinjam.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function kembalikan($id)
    {
        //
        $anggota =  Anggota::all();
        $book = Book::all();

        $pinjam =  
        Pinjam::join('anggota','pinjam.anggota_id','=','anggota.anggota_id')
        ->join('book','pinjam.book_id','=','book.book_id')
        ->where('pinjam_id',$id)
        ->select([ 'pinjam.pinjam_id as pinjam_id','pinjam.pinjam_date as pinjam_date','anggota.email as email','anggota.anggota_id as anggota_id','book.book_id','anggota.fullname as fulllname','book.title as title','pinjam.quantity as quantity','pinjam.pinjam_status as pinjam_status'])
        ->firstOrFail();
        
        if($pinjam){

            return view('pinjam_kembalikan',compact('pinjam','anggota','book'));
        }else{
            return redirect()->route('pinjam.index')->with('error','pinjam not found');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $anggota =  Anggota::all();
        $book = Book::all();

        $pinjam =  
        Pinjam::join('anggota','pinjam.anggota_id','=','anggota.anggota_id')
        ->join('book','pinjam.book_id','=','book.book_id')
        ->where('pinjam_id',$id)
        ->select([ 'pinjam.pinjam_id as pinjam_id','pinjam.pinjam_date as pinjam_date','anggota.email as email','anggota.anggota_id as anggota_id','book.book_id','anggota.fullname as fulllname','book.title as title','pinjam.quantity as quantity','pinjam.pinjam_status as pinjam_status'])
        ->firstOrFail();

        

        if($pinjam){

            return view('pinjam_edit',compact('pinjam','anggota','book'));
        }else{
            return redirect()->route('pinjam.index')->with('error','pinjam not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($request->status_update == "Kembali"){
            // Mendapatkan buku yang masuk berdasarkan ID
            $buku = Book::findOrFail($request->book_id);
            
            // Menambahkan stok buku yang masuk ke stok total
            $buku->stock += $request->quantity;
            $buku->save();
        }else{
            // Mendapatkan buku yang masuk berdasarkan ID
            $buku = Book::findOrFail($request->book_id);
            $buku->stock += $request->quantity_asal;
            // Menambahkan stok buku yang masuk ke stok total
            $buku->stock -= $request->quantity;
            $buku->save();
        }
        Pinjam::where('pinjam_id',$id)->update([
            'pinjam_date'=> $request->pinjam_date,
            'kembali_date'=> $request->kembali_date,
            'anggota_id'=> $request->anggota_id,
            'book_id'=> $request->book_id,
            'quantity'=> $request->quantity,
            'pinjam_status'=> $request->pinjam_status
        ]);


        return redirect()->route('pinjam.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Pinjam::where('pinjam_id',$id)->delete();

        return redirect()->route('pinjam.index')->with('success','Successfully delete data');
    }

    public function getpinjamId(){

        $randomString = uniqid("pinjam_");

        return response()->json([
            'key'=>$randomString
        ]);
     }
}