<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Auth;
use DB;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $loggedIn = Auth::user();
        if($request->has('search')){
            $suratmasuk = DB::table('suratmasuk')
                            ->where('nama_pengirim' , 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('nomor_surat', 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('klasifikasi', 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('disposisi', 'LIKE' , '%' .$request->search. '%')
                            ->orderBy('id','desc')
                            ->cursorPaginate(10);
        }else{
            $suratmasuk = SuratMasuk::orderBy('id','desc')->cursorPaginate(10);
        }
        
        return view('suratmasuk.index', compact('loggedIn','suratmasuk'));
    }
    public function periode(Request $request)
    {
        // dd($request->tanggal_awal);
        $tanggal_awal = date('y-m-d',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('y-m-d',strtotime($request->tanggal_akhir));
        $title = "list data dari tanggal $tanggal_awal sampai tanggal $tanggal_akhir";
        $loggedIn = Auth::user();
        $suratmasuk = DB::table('suratmasuk')
                        ->where('created_at','>=',$tanggal_awal.' 00:00:00')
                        ->where('created_at','<=',$tanggal_akhir.' 23:59:59')
                        ->get();
        // dd($tanggal_awal.'00:00:00');
        
        return view('suratmasuk.index', compact('loggedIn','suratmasuk'));
    }
    public function create(Request $request)
    {
        $suratmasuk = new \App\Models\SuratMasuk;
        $suratmasuk->nama_pengirim = $request->nama_pengirim;
        $suratmasuk->nomor_surat = $request->nomor_surat;
        $suratmasuk->perihal = $request->perihal;
        $suratmasuk->klasifikasi = $request->klasifikasi;
        $suratmasuk->disposisi = $request->disposisi;
        $suratmasuk->file = $suratmasuk->setFile($request->file);
        $suratmasuk->save();
        return redirect('/suratmasuk')->with('sukses','Data berhasil di input');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'editnamapengirim'  => 'required',
            'editnomorsurat'    => 'required',
            'editperihal'       => 'required',
            'editklas'          => 'required',
        ]);

        $suratmasuk = \App\Models\SuratMasuk::find($id);
        $suratmasuk->nama_pengirim = $request->editnamapengirim;
        $suratmasuk->nomor_surat = $request->editnomorsurat;
        $suratmasuk->perihal = $request->editperihal;
        $suratmasuk->klasifikasi = $request->editklas;

        if (!empty($request->editfile)) {

            $request->validate([
                'editfile' => 'required|mimes:pdf',
            ]);

            if (!empty($suratmasuk->file)) {
                
                $suratmasuk->removeFile($suratmasuk->file);

                $suratmasuk->file = $suratmasuk->setFile($request->file('editfile'));
            }
        }
        
        $suratmasuk->save();

        return redirect('/suratmasuk')->with('sukses', 'Data berhasil di update.');
    }
    public function disposisi(Request $request, $id)
    {
        $suratmasuk = \App\Models\SuratMasuk::find($id);
        $suratmasuk->disposisi = $request->disposisi;
        $suratmasuk->ket_disposisi = $request->updatedispoket;
        $suratmasuk->save();
        return redirect('/suratmasuk')->with('sukses', 'Data berhasil di update.');
    }
    public function tindaklanjut(Request $request, $id)
    {
        $suratmasuk = \App\Models\SuratMasuk::find($id);
        $suratmasuk->tindak_lanjut = $request->updatekettl;
        $suratmasuk->save();
        return redirect('/suratmasuk')->with('sukses', 'Data berhasil di update.');
    }
    public function delete($id)
    {
        $suratmasuk = \App\Models\SuratMasuk::find($id);

        if (!empty($suratmasuk->file)) {
            $suratmasuk->removeFile($suratmasuk->file);
        }
        $suratmasuk->delete($suratmasuk);
        return redirect('/suratmasuk')->with('sukses', 'Data berhasil di delete.');
    }
}
