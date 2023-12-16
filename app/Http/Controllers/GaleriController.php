<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\SuratMasuk;
use Auth;
use DB;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $loggedIn = Auth::user();
        $galeri = Galeri::all();
        if($request->has('search')){
            $suratmasuk = DB::table('suratmasuk')
                             ->where('nomor_surat' , 'LIKE' , '%' .$request->search. '%')
                             ->orWhere('perihal', 'LIKE' , '%' .$request->search. '%')
                             ->orWhere('file', 'LIKE' , '%' .$request->search. '%')
                             ->paginate(5);
        }else{
            $suratmasuk = SuratMasuk::paginate(5);
            
        }
       
        
        return view('galeri.index', compact('loggedIn','galeri', 'suratmasuk'));
    }
    
}
