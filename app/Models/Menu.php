<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gambar',
        'harga',
        'deskripsi',
        'kategori',
        'status',
        'urutan'
    ];

    protected $casts = [
        'harga' => 'integer',
        'status' => 'boolean',
        'urutan' => 'integer'
    ];

    // Constants for categories
    const KATEGORI_MAKANAN = 'makanan';
    const KATEGORI_MINUMAN = 'minuman';

    // Get all categories
    public static function getKategoriList()
    {
        return [
            self::KATEGORI_MAKANAN => 'Makanan',
            self::KATEGORI_MINUMAN => 'Minuman'
        ];
    }

    // Scope for active menus
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for food category
    public function scopeMakanan($query)
    {
        return $query->where('kategori', self::KATEGORI_MAKANAN);
    }

    // Scope for drink category
    public function scopeMinuman($query)
    {
        return $query->where('kategori', self::KATEGORI_MINUMAN);
    }

    // Scope for ordering by urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    // Format price with Indonesian currency
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Get category label
    public function getKategoriLabelAttribute()
    {
        $kategoriList = self::getKategoriList();
        return $kategoriList[$this->kategori] ?? $this->kategori;
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return null;
    }
} 