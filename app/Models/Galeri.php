<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'suratmasuk';
    protected $fillable = ['id','nomor_surat','perihal','file', 'status'];
}
