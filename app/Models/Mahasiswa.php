<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Mahasiswa: mewakili tabel `mahasiswa`.
 */
class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;      // NIM bukan angka auto increment
    protected $keyType = 'string';
    protected $fillable = ['nim', 'nama', 'alamat', 'tanggal_lahir', 'gender'];
    protected $casts = ['tanggal_lahir' => 'date'];

    //FUNGSI: usia dihitung otomatis dari tanggal lahir. 
    protected function usia(): Attribute
    {
        return Attribute::get(fn () => $this->tanggal_lahir->age);
    }

    /** FUNGSI filter nama untuk pencarian (kata kosong = tanpa filter). */
    public function scopeCari(Builder $query, ?string $kata): Builder
    {
        return $kata ? $query->where('nama', 'like', '%' . $kata . '%') : $query;
    }

    /** FUNGSI rekap jumlah per gender, hasil */
    public static function rekapGender(): array
    {
        $hasil = static::selectRaw('gender, COUNT(*) AS jumlah')
            ->groupBy('gender')->pluck('jumlah', 'gender')->all();

        return ['L' => $hasil['L'] ?? 0, 'P' => $hasil['P'] ?? 0];
    }
}