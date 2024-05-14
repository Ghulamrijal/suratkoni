<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Auth;
use DB;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $loggedIn = Auth::user();
        if($request->has('search')){
            $suratkeluar = DB::table('suratkeluar')
                            ->where('nama_pengirim' , 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('nomor_surat', 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('klasifikasi', 'LIKE' , '%' .$request->search. '%')
                            ->orWhere('disposisi', 'LIKE' , '%' .$request->search. '%')
                            ->cursorPaginate(10);
        }else{
            $suratkeluar = SuratKeluar::cursorPaginate(10);
        }
        
        return view('suratkeluar.index', compact('loggedIn','suratkeluar'));
    }
    public function create(Request $request)
    {
        $suratkeluar = new \App\Models\SuratKeluar;
        $suratkeluar->nama_pengirim = $request->nama_pengirim;
        $suratkeluar->nomor_surat = $request->nomor_surat;
        $suratkeluar->perihal = $request->perihal;
        $suratkeluar->klasifikasi = $request->klasifikasi;
        $suratkeluar->disposisi = $request->disposisi;
        $suratkeluar->file = $suratkeluar->setFile($request->file);
        $suratkeluar->save();
        return redirect('/suratkeluar')->with('sukses','Data berhasil di input');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'editnamapengirim'  => 'required',
            'editnomorsurat'    => 'required',
            'editperihal'       => 'required',
            'editklas'          => 'required',
        ]);

        $suratkeluar = \App\Models\SuratKeluar::find($id);
        $suratkeluar->nama_pengirim = $request->editnamapengirim;
        $suratkeluar->nomor_surat = $request->editnomorsurat;
        $suratkeluar->perihal = $request->editperihal;
        $suratkeluar->klasifikasi = $request->editklas;

        if (!empty($request->editfile)) {

            $request->validate([
                'editfile' => 'required|mimes:pdf',
            ]);

            if (!empty($suratkeluar->file)) {
                
                $suratkeluar->removeFile($suratkeluar->file);

                $suratkeluar->file = $suratkeluar->setFile($request->file('editfile'));
            }
        }
        
        $suratkeluar->save();

        return redirect('/suratkeluar')->with('sukses', 'Data berhasil di update.');
    }
    public function disposisi(Request $request, $id)
    {
        $suratkeluar = \App\Models\SuratKeluar::find($id);
        $suratkeluar->disposisi = $request->disposisi;
        $suratkeluar->ket_disposisi = $request->updatedispoket;
        $suratkeluar->save();
        return redirect('/suratkeluar')->with('sukses', 'Data berhasil di update.');
    }
    public function tindaklanjut(Request $request, $id)
    {
        $suratkeluar = \App\Models\SuratKeluar::find($id);
        $suratkeluar->tindak_lanjut = $request->updatekettl;
        $suratkeluar->save();
        return redirect('/suratkeluar')->with('sukses', 'Data berhasil di update.');
    }
    public function delete($id)
    {
        $suratkeluar = \App\Models\SuratKeluar::find($id);

        if (!empty($suratkeluar->file)) {
            $suratkeluar->removeFile($suratkeluar->file);
        }
        $suratkeluar->delete($suratkeluar);
        return redirect('/suratkeluar')->with('sukses', 'Data berhasil di delete.');
    }
}
