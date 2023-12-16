<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'suratmasuk';
    protected $fillable = ['id','nama_pengirim','nomor_surat','perihal','klasifikasi','disposisi','file','ket_disposisi','tindak_lanjut'];

    public function setFile($file)
    {
        $img_temp = $file;
        $filename =  time().'-'.$img_temp->getClientOriginalName();
        if (!file_exists(public_path('/admin/assets/file'))) {
            mkdir(public_path('/admin/assets/file'), 0777, true);
        }
        $destination_path = public_path('/admin/assets/file/');
        $img_temp->move($destination_path, $filename);

        return $filename;
    }

    public function removeFile($filename)
    {
        if (file_exists(public_path('/admin/assets/file/'.$filename))) {
            unlink(public_path('/admin/assets/file/'.$filename));
        }
    }
}
