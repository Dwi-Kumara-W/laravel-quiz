<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = DB::table('barang')->get();
    	return view('index',['barang' => Barang::latest()->paginate(10)]);
    }

    public function tambah()
    {
    	return view('tambah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ]);

        Barang::create($attributes);

        return redirect( route('barang.index') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
    {
        $barang = Barang::where('id_barang',$id_barang)->get();
	    return view('editbarang',['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Barang::where('id_barang',$request->id_barang)->update([
		    'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga
	    ]);

	    return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        Barang::where('id_barang',$id_barang)->delete();
        return redirect( route('barang.index') );
    }

    public function cari(Request $request){
	// menangkap data pencarian
	$cari = $request->cari;

	$barang = Barang::where('nama_barang','like',"%".$cari."%")
    ->orWhere('deskripsi', 'like', '%' . $cari.'%')
	->paginate();

	return view('index',['barang' => $barang]);

    }
}
