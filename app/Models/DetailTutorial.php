<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTutorial extends Model
{
    // Mengizinkan kolom detail untuk diisi
    protected $fillable = [
        'master_tutorial_id',
        'text',
        'gambar',
        'code',
        'url',
        'order',
        'status',
    ];

    // Relasi ke tabel Master (Kebalikan dari hasMany)
    public function master()
    {
        return $this->belongsTo(MasterTutorial::class, 'master_tutorial_id');
    }
}