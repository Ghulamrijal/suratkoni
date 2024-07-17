<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'suratkeluar';
    protected $fillable = ['id','nama_pengirim','nomor_surat','perihal','klasifikasi','file','ket_disposisi','tindak_lanjut'];

    public function setFile($file)
    {
        $img_temp = $file;
        $filename =  time().'-'.$img_temp->getClientOriginalName();
        if (!file_exists(public_path('/admin/assets/filekeluar'))) {
            mkdir(public_path('/admin/assets/filekeluar'), 0777, true);
        }
        $destination_path = public_path('/admin/assets/filekeluar/');
        $img_temp->move($destination_path, $filename);

        return $filename;
    }

    public function removeFile($filename)
    {
        if (file_exists(public_path('/admin/assets/filekeluar/'.$filename))) {
            unlink(public_path('/admin/assets/filekeluar/'.$filename));
        }
    }
}
