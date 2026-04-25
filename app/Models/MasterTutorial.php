<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTutorial extends Model
{
    // Mengizinkan kolom-kolom ini untuk diisi melalui form (Mass Assignment)
    protected $fillable = [
        'judul',
        'kode_mata_kuliah',
        'url_presentation',
        'url_finished',
        'creator_email',
    ];

    // Sekalian tambahkan relasi One-to-Many ke DetailTutorial
    // Ini nanti sangat berguna saat kamu fetch data di PublicTutorialController
    public function details()
    {
        return $this->hasMany(DetailTutorial::class);
    }
}