<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
  //use HasFactory;
  protected $fillable =[
     'nama_barang',
     'j_barang',
     'harga_barang',
     'tgl_transaksi',
     'tunai',
     'kembalian',
     'total_barang',
     'total_harga',
     'nama_petugas',
           
       ];
}
