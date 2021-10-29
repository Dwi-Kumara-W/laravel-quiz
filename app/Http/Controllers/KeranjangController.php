<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\DetailKeranjang;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = DB::table('barang')->get();
    	// return view('order',['barang' => $barang]);
        return view('order',['barang' => Barang::latest()->paginate(10)]);
    }

    public function index_keranjang()
    {
        $keranjang = DB::table('keranjang')
            ->join('users', 'keranjang.id_user', '=', 'users.id_user')
            ->where('status',"Lunas")
            ->get();
        // $keranjang = DB::table('keranjang')->where('status',"Lunas")->get();
    	return view('customer',['keranjang' => $keranjang]);
    }

    public function index_laporan()
    {
        $keranjang = DB::table('keranjang')
            ->join('users', 'keranjang.id_user', '=', 'users.id_user')
            ->where('keranjang.status',"Dikirim")
            ->get();
        // $keranjang = DB::table('keranjang')->join('barang', 'keranjang.id_barang','=','barang.id')->where('status',"Dikirim")->get();
    	return view('laporan',['keranjang' => $keranjang]);
    }

    public function index_detail_laporan(Request $request)
    {
        $keranjang = DB::table('detail_keranjang')
            ->join('keranjang', 'detail_keranjang.id_keranjang', '=', 'keranjang.id_keranjang')
            ->join('barang', 'detail_keranjang.id_barang', '=', 'barang.id_barang')
            ->join('users', 'keranjang.id_user', '=', 'users.id_user')
            ->where('keranjang.id_keranjang',$request->id_keranjang)
            ->get();
        // $keranjang = DB::table('keranjang')->join('barang', 'keranjang.id_barang','=','barang.id')->where('status',"Dikirim")->get();
    	return view('detaillaporan',['keranjang' => $keranjang]);
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

        $id_pengguna = 0;
        $nama_pengguna = "";
        $id_keranjang = 0;

        $barang = Barang::where('id_barang',$request->id_barang)->get()->first();
        $attributes_user = request()->validate([
            'nama_pembeli' => 'required',
            'alamat' => 'required',
            'nomertelp' => 'required'
        ]);

        User::create($attributes_user);
        $nama_pengguna = $request->nama_pembeli;
        $id_pengguna = User::where('nama_pembeli',$nama_pengguna)->value('id_user');
        Keranjang::create([
            'id_user' => $id_pengguna,
            'status' => $request->status
        ]);


        DB::table('barang')->where('id_barang',$request->id_barang)->update([
            'stok' => intval($barang->stok - $request->jumlah)
	    ]);

        $id_keranjang = Keranjang::orderByDesc('id_keranjang')->value('id_keranjang');

        DetailKeranjang::create([
            'id_keranjang' => $id_keranjang,
            'id_barang' => $request->id_barang,
            'harga' => $request->harga_barang,
            'jumlah' => $request->jumlah,
            'total' => $request->total
        ]);

        return redirect('/order');
    }

    public function update_status(Request $request)
    {
	    Keranjang::where('id_keranjang',$request->id_keranjang)->update([
		    'status' => "Dikirim"
	    ]);

	    return redirect('/laporan');
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
	    return view('checkout',['barang' => $barang]);
    }

    public function edit_status($id_keranjang)
    {
        $keranjang = DetailKeranjang::join('keranjang', 'detail_keranjang.id_keranjang', '=', 'keranjang.id_keranjang')
            ->join('barang', 'detail_keranjang.id_barang', '=', 'barang.id_barang')
            ->join('users', 'keranjang.id_user', '=', 'users.id_user')
            ->where('keranjang.id_keranjang',$id_keranjang)
            ->get();
        // $keranjang = DB::table('keranjang')->where('id',$id)->get();
	    return view('detailcustomer',['keranjang' => $keranjang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari(Request $request){
	// menangkap data pencarian
	$cari = $request->cari;

	$barang = Barang::where('nama','like',"%".$cari."%")
    ->orWhere('deskripsi', 'like', '%' . $cari.'%')
	->paginate();

    	// mengirim data pegawai ke view index
	return view('/order',['barang' => $barang]);

    }
}
