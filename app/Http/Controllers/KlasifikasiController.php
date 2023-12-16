<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Klasifikasi;
use DB;


class KlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $loggedIn = Auth::user();
        if($request->has('search')){
            $klasifikasi = DB::table('klasifikasi')
                             ->where('nama' , 'LIKE' , '%' .$request->search. '%')
                             ->orWhere('kode', 'LIKE' , '%' .$request->search. '%')
                             ->orWhere('uraian', 'LIKE' , '%' .$request->search. '%')
                             ->paginate(5);
        }else{
            $klasifikasi = klasifikasi::paginate(5);
        }
        return view('klasifikasi.index',['klasifikasi'=> $klasifikasi], compact('loggedIn','klasifikasi'));
    }
    public function create(Request $request)
    {
        $klasifikasi = new \App\Models\Klasifikasi;
        $klasifikasi->nama = $request->nama;
        $klasifikasi->kode = $request->kode;
        $klasifikasi->uraian = $request->uraian;
        $klasifikasi->save();
        return redirect('/klasifikasi')->with('sukses','Data berhasil di input');
    }
    public function update(Request $request,$id)
    {
        $klasifikasi = \App\Models\Klasifikasi::find($id);
        // $klasifikasi->update($request->all());
        $klasifikasi->nama = $request->updateInputnama;
        $klasifikasi->kode = $request->updateInputkode;
        $klasifikasi->uraian = $request->updateInputuraian;
        $klasifikasi->save();
        return redirect('/klasifikasi')->with('sukses','Data berhasil di update.');
    }
    
    public function delete($id)
    {
        $klasifikasi = \App\Models\Klasifikasi::find($id);
        $klasifikasi->delete();
        return redirect('/klasifikasi')->with('sukses','Data berhasil di delete.');
    }
    
}
