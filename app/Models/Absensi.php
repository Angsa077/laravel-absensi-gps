<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'foto_masuk',
        'foto_keluar',
        'lokasi',
    ];
    
    /**
     * Method user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    /**
     * Method foto_masuk
     *
     * @return Attribute
     */
    protected function foto_masuk(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/foto_masuk/' . $value),
        );
    }
    

    /**
     * Method foto_keluar
     *
     * @return Attribute
     */
    protected function foto_keluar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/foto_keluar/' . $value),
        );
    }
    
    
    /**
     * Method createdAt
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-M-Y H:i:s'),
        );
    }
}
